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
        <title>บัญชีผู้ใช้</title>
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
                            <!-- Breadcrumb & Active menu-->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="account-manage">บัญชีผู้ใช้</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="active">เพิ่มข้อมูล</a>
                                    </li>
                                </ol>
                            </nav>

                            <span class="active-menu-url">account-manage</span>
                            <!-- /Breadcrumb & Active menu-->

                            <div class="row g-3">
                                <!-- Card form -->
                                <div class="col-12">
                                    <div class="card mb-4">
                                        <h5 class="card-body py-3 mb-0 border-bottom">
                                            <i class="fa-solid fa-user-large me-1"></i>
                                            เพิ่มบัญชีผู้ใช้
                                        </h5>
                                        <div class="card-body">
                                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                <img src="../assets/img/avatars/default-avatar.png" alt="user avatar" class="d-block rounded fit-cover" height="100" width="100" id="uploadedAvatar">
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
                                            <form id="formCreateAccount" method="post" action="../data/user/createNewAccount">
                                                <div class="row g-3">
                                                    <input type="file" id="userProfile" class="d-none" name="userProfile" accept=".jpg,.jpeg,.png">
                                                    <div class="col-12 col-lg-6">
                                                        ชื่อ <span class="text-danger">*</span>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fa-regular fa-message"></i></span>
                                                            <input type="text" name="userFname" class="form-control" value="" maxlength="50" placeholder="ระบุชื่อ" autofocus autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        นามสกุล <span class="text-danger">*</span>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fa-regular fa-message"></i></span>
                                                            <input type="text" name="userLname" class="form-control" value="" maxlength="50" placeholder="ระบุนามสกุล" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        ระดับบัญชีผู้ใช้ <span class="text-danger">*</span>
                                                        <div class="btn-group w-100" role="group" aria-label="userLevel radio toggle">
                                                            <input id="memberRadio" type="radio" class="btn-check" name="userLevel" value="สมาชิก" required>
                                                            <label class="btn btn-outline-secondary w-50" for="memberRadio">
                                                                <i class="fa-solid fa-user me-1"></i>
                                                                สมาชิก
                                                            </label>

                                                            <input id="adminRadio" type="radio" class="btn-check" name="userLevel" value="ผู้ดูแลระบบ" required>
                                                            <label class="btn btn-outline-secondary w-50" for="adminRadio">
                                                                <i class="fa-solid fa-crown me-1"></i>
                                                                ผู้ดูแลระบบ
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        สถานะบัญชีผู้ใช้ <span class="text-danger">*</span>
                                                        <div class="btn-group w-100" role="group" aria-label="userStatus radio toggle">
                                                            <input id="normalRadio" type="radio" class="btn-check" name="userStatus" value="บัญชีปกติ" required>
                                                            <label class="btn btn-outline-secondary w-50" for="normalRadio">
                                                                <i class="fa-solid fa-check me-1"></i>
                                                                บัญชีปกติ
                                                            </label>

                                                            <input id="suspendedRadio" type="radio" class="btn-check" name="userStatus" value="บัญชีถูกระงับ" required>
                                                            <label class="btn btn-outline-secondary w-50" for="suspendedRadio">
                                                                <i class="fa-solid fa-xmark me-1"></i>
                                                                บัญชีถูกระงับ
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        Username <span class="text-danger">*</span>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                                            <input type="text" name="username" class="form-control" value="" maxlength="50" placeholder="ระบุ Username" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        รหัสผ่าน <span class="text-danger">*</span>
                                                        <div class="form-password-toggle">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                                                <input type="password" name="password" class="form-control" value="" minlength="8" maxlength="12" placeholder="ระบุรหัสผ่าน" autocomplete="off" required>
                                                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-text">ความยาวรหัสผ่าน 8-12 ตัวอักษร</div>
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
                                <!-- /Card form -->
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
            $('#formCreateAccount').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                let data =  new FormData($('#formCreateAccount')[0]);

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
                                    window.location.href="account-manage";
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

            //Control user status select
            let statusRadio = $('input[type="radio"][name="userStatus"]');
            statusRadio.change(function() {
                let userStatus = $(this).val();
                if(userStatus == "บัญชีถูกระงับ"){
                    Swal.fire({
                        icon: 'info',
                        title: "ระงับการใช้งานบัญชีผู้ใช้",
                        text: 'บัญชีผู้ใช้ที่ถูกระงับการใช้งานจะไม่สามารถเข้าสู่ระบบได้',
                        showConfirmButton: true,
                        confirmButtonText: "เข้าใจแล้ว"
                    });
                }
            });

            //Control user level select
            let levelRadio = $('input[type="radio"][name="userLevel"]');
            levelRadio.change(function() {
                let userLevel = $(this).val();
                if(userLevel == "ผู้ดูแลระบบ"){
                    Swal.fire({
                        icon: 'info',
                        title: "สร้างบัญชีผู้ดูแลระบบ",
                        text: 'ผู้ใช้บัญชีจะสามารถจัดการข้อมูลภายในระบบทั้งหมดได้',
                        showConfirmButton: true,
                        confirmButtonText: "เข้าใจแล้ว"
                    });
                }
            });
        </script>
    </body>
</html>

<?php
    //Close connection
    $database->close();
?>