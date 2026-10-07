<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="row justify-content-center">

    <div class="col-md-8">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">
                    <i class="bi bi-person-circle"></i>
                    My Profile
                </h3>
            </div>

            <div class="card-body">

                <!-- Success / Error Message -->
                <?php if (!empty($message)): ?>

                    <div class="alert alert-<?= htmlspecialchars($messageType) ?>">
                        <?= htmlspecialchars($message) ?>
                    </div>

                <?php endif; ?>


                <!-- Profile Picture -->
                <div class="text-center mb-4">

                    <?php if (
                        !empty($user['profile_picture']) &&
                        file_exists(__DIR__ . '/../../uploads/profile/' . $user['profile_picture'])
                    ): ?>

                        <img
                            src="uploads/profile/<?= htmlspecialchars($user['profile_picture']) ?>"
                            alt="Profile Picture"
                            class="rounded-circle border"
                            style="
                                width: 160px;
                                height: 160px;
                                object-fit: cover;
                            "
                        >

                    <?php else: ?>

                        <div
                            class="rounded-circle bg-light border d-flex align-items-center justify-content-center mx-auto"
                            style="
                                width: 160px;
                                height: 160px;
                            "
                        >
                            <i
                                class="bi bi-person"
                                style="font-size: 80px;"
                            ></i>
                        </div>

                    <?php endif; ?>

                </div>


                <!-- Upload Form -->
                <div class="mb-4">

                    <h5 class="mb-3">
                        Upload Profile Picture
                    </h5>

                    <form
                        action="index.php?page=profile"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        <div class="mb-3">

                            <label
                                for="profile_picture"
                                class="form-label"
                            >
                                Select Profile Picture
                            </label>

                            <input
                                type="file"
                                name="profile_picture"
                                id="profile_picture"
                                class="form-control"
                                accept=".jpg,.jpeg,.png"
                                required
                            >

                            <div class="form-text">
                                Only JPG, JPEG and PNG files are allowed.
                                Maximum file size is 2MB.
                            </div>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="bi bi-upload"></i>
                            Upload Picture
                        </button>

                    </form>

                </div>


                <hr>


                <!-- Student Information -->
                <h5 class="mb-3">
                    Student Information
                </h5>

                <div class="row mb-3">

                    <div class="col-sm-4">
                        <strong>Name</strong>
                    </div>

                    <div class="col-sm-8">
                        <?= htmlspecialchars($user['name']) ?>
                    </div>

                </div>


                <div class="row mb-3">

                    <div class="col-sm-4">
                        <strong>NRIC</strong>
                    </div>

                    <div class="col-sm-8">
                        <?= htmlspecialchars($user['nric']) ?>
                    </div>

                </div>


                <div class="row mb-3">

                    <div class="col-sm-4">
                        <strong>Program</strong>
                    </div>

                    <div class="col-sm-8">
                        <?= htmlspecialchars($user['program']) ?>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>