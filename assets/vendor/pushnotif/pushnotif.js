const applicationServerKey = "BArB1CCO00pkMSnndFT0CB2ZzVW31oIXiQI5Nqd9T3HyrbXAqKf1Ikn-auY-dHqHVp8KFUrmJ8ZpT-TY-D5Jj8Y";
let pushButton = $('.js-push-btn');
let serviceWorkerRegistration = null;
let isPushSubscribed = false;

$(document).ready(function () {
    if (!('serviceWorker' in navigator)) {
        return;
    }
    if (!('PushManager' in window)) {
        return;
    }
    navigator.serviceWorker.register(url_+'/assets/vendor/pushnotif/sw.js')
        .then(function (registration) {
            serviceWorkerRegistration = registration;
            pushButton.show();
            initializePushMessage();
        }).catch(function (error) {
            console.error('Unable to register service worker.', error);
        });

    pushButton.on('click', function () {
        pushButton.prop('disabled', true);
        if (isPushSubscribed) {
            unsubscribeUserFromPush();
        } else {
            subscribeUserToPush()
                .then(function () {
                    updateBtn();
                })
                .catch(function (error) {
                    alert('Error:' + error);
                });
        }
    });
});

function initializePushMessage() {
    serviceWorkerRegistration.pushManager.getSubscription()
        .then(function (subscription) {
            isPushSubscribed = !(subscription === null);
            updateBtn();
            if (!isPushSubscribed) {
                subscribeUserToPush()
                    .then(function () {
                        updateBtn();
                    })
                    .fail(function (error) {
                        console.error('Error subscribing user to push', error);
                    });
            }
        });
}

function unsubscribeUserFromPush() {
    pushButton.prop('disabled', true);

    serviceWorkerRegistration.pushManager.getSubscription()
        .then(function (subscription) {
            if (subscription) {
                subscription.unsubscribe();
                return subscription;
            }
        })
        .then(function (subscription) {
            updateSubscriptionOnServer(subscription, false);

            isPushSubscribed = false;
            updateBtn();
        })
        .catch(function (error) {
            alert('Error unsubscribing');
        });
}

function updateBtn() {
    if (Notification.permission === 'denied') {
        pushButton.text('Push Messaging Blocked.').prop('disabled', true);
        return;
    }

    if (isPushSubscribed) {
        pushButton.text('Unsubscribe Push Messaging');
    } else {
        pushButton.text('Subscribe Push Messaging');
    }
    pushButton.prop('disabled', false);
}

function getNotificationPermission() {
    return new Promise(function (resolve, reject) {
        if (!("Notification" in window)) {
            reject('support');
        } else {
            Notification.requestPermission(function (permission) {
                (permission === 'granted') ? resolve(permission): reject(permission);
            });
        }
    });
}

function subscribeUserToPush() {
    return getNotificationPermission().then(function (status) {
        const subscribeOptions = {
            userVisibleOnly: true,
            applicationServerKey: urlBase64ToUint8Array(applicationServerKey)
        };
        return serviceWorkerRegistration.pushManager.subscribe(subscribeOptions)
            .then(function (subscription) {
                return updateSubscriptionOnServer(subscription).then(function (status) {
                    isPushSubscribed = true;
                    updateBtn();
                    return status;
                });
            });
    });
}

function updateSubscriptionOnServer(subscription = null, subscribe = true) {
    return new Promise(function (resolve, reject) {
        let extra = (subscribe) ? '?subscribe' : '?unsubscribe';
        $.ajax({
            url: url_ + '/Save_subscription' + extra,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(subscription),
            success: function (responseData) {
                if (!responseData.status || responseData.status !== 'ok') {
                    reject(responseData.status);
                } else {
                    resolve(responseData.status);
                }
            },
            error: function (error) {
                reject(error);
            }
        });
    });
}

function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}