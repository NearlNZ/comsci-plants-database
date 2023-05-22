<?php
    //Include database connection
    require_once("../data/database.php");

    //Include admin account check
    require_once('../include/scripts/admin-header.php');
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed">
    <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>บัญชีของฉัน</title>
        <link rel="shortcut icon" href="../assets/img/element/tab-logo.ico" type="image/x-icon">

        <!-- Fonts -->
        <link rel="stylesheet" href="../assets/font/Kanit.css"/>

        <!-- Template CSS -->
        <link rel="stylesheet" href="../assets/css/template.css"/>
        
        <!-- Core JS -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="../assets/vendor//perfect-scrollbar/perfect-scrollbar.css"/>
        <link rel="stylesheet" href="../assets/vendor/boxicons/boxicons.css"/>

        <!-- Vendors JS -->
        <script src="../assets/vendor/fontawesome/js/all.min.js"></script>
        <script src="../assets/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="../assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>

        <!-- Page Style -->
        <link rel="stylesheet" href="../assets/css/custom-style.css"/>
    </head>
    <body class="body-light">
        <!-- Wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Sidebar -->
                <?php require_once("../include/components/sidebar-admin.php");?>
                <!-- /Sidebar -->

                <!-- Page -->
                <div class="layout-page">
                    <!-- Navbar -->
                    <?php require_once("../include/components/navbar-account.php");?>
                    <!-- /Navbar -->

                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Content -->
                        <div class="container-fluid flex-grow-1 container-p-y">
                            <div class="row g-3">
                                <!-- Card info form -->
                                <div class="col-12">
                                    <div class="card">
                                        <h5 class="card-body py-3 mb-0 border-bottom">
                                            <i class="fa-solid fa-user-large me-1"></i>
                                            แก้ไขข้อมูลส่วนตัว
                                        </h5>
                                        <div class="card-body">
                                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                <img src="../assets/img/avatars/<?php echo $currentUser->userProfile; ?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                                                <div class="button-wrapper">
                                                    <label id="uploadButton" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                        <span class="d-none d-sm-block">อัพโหลดรูปภาพ</span>
                                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                                    </label>
                                                    <button id="fileReset" type="button" class="btn btn-label-secondary mb-4">
                                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">รีเซ็ต</span>
                                                    </button>
                                                    <p class="text-muted mb-0">รองรับไฟล์รูปภาพ JPG, JPEG และ PNG</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-0">

                                        <div class="card-body">
                                            <form id="formUpdateProfile" method="post" action="../data/user/owner-updateAccount">
                                                <div class="row g-3">
                                                    <input type="hidden" name="userID" value="<?php echo $currentUser->userID; ?>">
                                                    <input type="file" id="userProfile" class="d-none" name="userProfile" accept=".jpg,.jpeg,.png">
                                                    <input type="hidden" name="userCurrentProfile" value="<?php echo $currentUser->userProfile; ?>">
                                                    <div class="col-12 col-lg-6">
                                                        ชื่อ
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fa-regular fa-message"></i></span>
                                                            <input type="text" name="userFname" class="form-control" maxlength="50" placeholder="ระบุชื่อ" autofocus autocomplete="off" required
                                                            value="<?php echo $currentUser->userFname; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        นามสกุล
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fa-regular fa-message"></i></span>
                                                            <input type="text" name="userLname" class="form-control" maxlength="50" placeholder="ระบุนามสกุล" autocomplete="off" required
                                                            value="<?php echo $currentUser->userLname; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-primary me-2">บันทึกข้อมูล</button>
                                                    <a href="#" onclick="goBack()" class="btn btn-label-secondary">ย้อนกลับ</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Card info form -->

                                <!-- Card reset password form -->
                                <div class="col-12">
                                    <div class="card">
                                        <h5 class="card-header py-3 mb-0">
                                            <i class="fa-solid fa-user-shield me-1"></i>
                                            เปลี่ยนรหัสผ่าน
                                        </h5>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 order-md-0 order-1">
                                                    <form id="formResetPassword" method="post" action="../data/user/owner-resetPassword">
                                                        <input type="hidden" name="userID" value="<?php echo $currentUser->userID; ?>">
                                                        <div class="row g-3">
                                                            <div class="col-12">
                                                                ยืนยันรหัสผ่านปัจจุบัน
                                                                <div class="form-password-toggle">
                                                                    <div class="input-group input-group-merge">
                                                                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                                                        <input type="password" name="currentPassword" class="form-control" value="" minlength="8" maxlength="12" placeholder="· · · · · · · · · · · ·" autocomplete="off" required>
                                                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                รหัสผ่านใหม่
                                                                <div class="form-password-toggle">
                                                                    <div class="input-group input-group-merge">
                                                                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                                                        <input type="password" name="newPassword" class="form-control" value="" minlength="8" maxlength="12" placeholder="· · · · · · · · · · · ·" autocomplete="off" required>
                                                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-text">ความยาวรหัสผ่าน 8-12 ตัวอักษร</div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <button type="submit" class="btn btn-primary me-2">เปลี่ยนรหัสผ่าน</button>
                                                            <button type="reset" class="btn btn-label-secondary">ยกเลิก</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-md-6 order-md-1 order-0">
                                                    <div class="text-center mx-3 mx-md-0 mb-4 mb-md-0">
                                                        <img src="../assets/img/element/img-reset-password.png" class="img-fluid" alt="Reset Password" width="300">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Card reset password form -->

                                <!-- Card delete account form -->
                                <div class="col-12">
                                    <div class="card mb-2">
                                        <h5 class="card-header py-3 mb-0">
                                            <i class="fa-solid fa-user-xmark me-1"></i>
                                            ลบบัญชีผู้ใช้ถาวร
                                        </h5>
                                        <div class="card-body">
                                            <div class="mb-3 col-12 mb-0">
                                                <div class="alert alert-warning">
                                                    <h6 class="alert-heading fw-bold mb-2">คุณแน่ใจหรือไม่ที่จะดำเนินการลบบัญชีผู้ใช้ ?</h6>
                                                    <p class="mb-0">
                                                        หลังจากที่ดำเนินการลบบัญชีผู้ใช้ไปแล้ว จะไม่สามารถกู้คืนข้อมูลบัญชีผู้ใช้ได้ในภายหลัง โปรดพิจารณาให้ถี่ถ้วนก่อนดำเนินการ
                                                    </p>
                                                </div>
                                            </div>
                                            <form id="formDeleteAccount" method="post" action="../data/user/owner-deleteAccount">
                                                <input type="hidden" name="userID" value="<?php echo $currentUser->userID; ?>">
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input border-secondary" type="checkbox" name="confirmDelete" id="confirmDelete" required>
                                                    <span class="form-check-label" for="confirmDelete">
                                                        ฉันได้อ่านคำเตือน และยืนยันที่จะดำเนินการลบบัญชีผู้ใช้ต่อไป
                                                    </span>
                                                </div>
                                                <button type="submit" id="deleteButton" class="btn btn-danger deactivate-account" disabled>ลบบัญชีผู้ใช้</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Card delete account form -->
                            </div>
                        </div>
                        <!-- /Content -->

                        <!-- Footer -->
                        <?php require_once("../include/components/footer.php");?>
                        <!-- /Footer -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- /Content wrapper -->
                </div>
                <!-- /Page -->
            </div>

            <!-- Page overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- /Wrapper -->

        <!-- Template JS -->
        <script src="../assets/js/template.js"></script>

        <!-- Page JS -->
        <script src="../include/scripts/customFunctions.js"></script>
        <script>
            //Update profile data
            $('#formUpdateProfile').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                let data =  new FormData($('#formUpdateProfile')[0]);

                ajaxRequest({
                    type: 'POST',
                    url: form.attr('action'),
                    processData: false,
                    contentType: false,
                    data: data,
                    successCallback: function(response) {
                        if(response.status == "success"){
                            showResponse({
                                response: response,
                                timer: 2000,
                                callback: function() {
                                    window.location.reload();
                                }
                            });
                        }else{
                            showResponse({
                                response: response
                            });
                        }
                    }
                });
            });

            //Reset password
            $('#formResetPassword').submit(function(e) {
                e.preventDefault();
                let form = $(this);

                ajaxRequest({
                    type: 'POST',
                    url: form.attr('action'),
                    data: form.serialize(),
                    successCallback: function(response) {
                        if(response.status == "success"){
                            showResponse({
                                response: response,
                                timer: 2000,
                                callback: function() {
                                    window.location.reload();
                                }
                            });
                        }else{
                            showResponse({
                                response: response
                            });
                        }
                    }
                });
            });

            //Delete account
            $('#formDeleteAccount').submit(function(e) {
                e.preventDefault();
                let form = $(this);

                showConfirm({
                    icon: 'question',
                    text: 'คุณแน่ใจหรือไม่ที่จะดำเนินการลบบัญชีผู้ใช้ ?',
                    confirmButtonText: 'ดำเนินการต่อ',
                    confirmCallback: function(){
                        ajaxRequest({
                            type: 'post',
                            url: form.attr('action'),
                            data: form.serialize(),
                            successCallback: function(response) {
                                if(response.status == "success"){
                                    showResponse({
                                        response: response,
                                        timer: 2000,
                                        callback: function() {
                                            window.location.href = "../logout.php";
                                        }
                                    });
                                }else{
                                    showResponse({
                                        response: response
                                    });
                                }
                            }
                        });
                    }
                });
            });

            //Control avartar upload
            let uploadedAvatar = document.getElementById("uploadedAvatar");
            const fileInput = document.getElementById("userProfile");
            const uploadButton = document.getElementById("uploadButton");
            const fileReset = document.getElementById("fileReset");
            if(uploadedAvatar){
                const oldAvartar = uploadedAvatar.src;
                uploadButton.onclick=()=>{
                    fileInput.click();
                }

                fileInput.onchange=()=>{
                    fileInput.files[0]&&(uploadedAvatar.src=window.URL.createObjectURL(fileInput.files[0]));
                }
                    
                fileReset.onclick=()=>{
                    fileInput.value="";
                    uploadedAvatar.src = oldAvartar;
                }
            }

            //Control delete acount submit
            let confirmDelete = $('#confirmDelete');
            let deleteButton = $('#deleteButton');

            confirmDelete.on('change', function() {
                if (confirmDelete.is(':checked')) {
                    deleteButton.removeAttr('disabled');
                } else {
                    deleteButton.attr('disabled', 'disabled');
                }
            });
        </script>
    </body>
</html>

<?php
    //Close connection
    $database->close();
?>