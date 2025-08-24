<style>
    .map-btn {
        background-color: white;
        color: #1A44B2;
        border: 1px solid #1A44B2;
        border-radius: 7px;
        transition: background-color 0.3s, color 0.3s;
        font-size: 12px;
        padding: 3px 3px;
    }

    .map-btn:hover {
        background-color: #ff0000;
        color: #ffffff;
        border: 1px solid white;
    }

    .map-btn.active {
        background-color: #1A44B2;
        color: white;
        border-radius: 7px;
        font-size: 14px;
        padding: 5px 5px;
    }

    .map-btn:last-child {
        margin-right: 0;
    }

    .tab-pane svg {
        width: 100%;
        height: 100%;
    }

    .tab-pane {
        padding: 0;
        margin: 0;
    }
</style>
<section>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <?php if (isset($error_message) && !empty($error_message)) : ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <?= htmlspecialchars($error_message); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <div class="demo-inline-spacing">
                            <?php foreach ($map_prov as $index => $data) : ?>
                                <button type="button"
                                    class="btn btn-sm map-btn shadow-lg <?php echo $index === 0 ? 'active' : ''; ?>" role="tab"
                                    data-bs-toggle="tab" data-id="<?= htmlspecialchars($data['id']); ?>"
                                    data-id_prov="<?= htmlspecialchars($data['id_prov']); ?>"
                                    data-bs-target="#map-<?= htmlspecialchars($data['id']); ?>"
                                    aria-controls="map-<?= htmlspecialchars($data['id']); ?>"
                                    aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                                    <span class="tf-icons bx bx-map-pin"></span>&nbsp;
                                    <?= htmlspecialchars($data['nama_provinsi']); ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </ul>
                    <?php foreach ($map_prov as $index => $data) : ?>
                        <div class="tab-pane fade <?php echo $index === 0 ? 'show active' : ''; ?>"
                            id="map-<?= htmlspecialchars($data['id']); ?>" role="tabpanel">
                            <div class="error-message-container"></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>