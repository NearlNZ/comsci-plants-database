<?php
    //include permission check
    require_once('../include/scripts/admin-header.php');
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>จัดการข้อมูลหมวดหมู่พืช</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="../assets/font/Kanit.css"/>

        <!-- Template CSS -->
        <link rel="stylesheet" href="../assets/css/template.css"/>
        
        <!-- Core JS -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="../assets/vendor/perfect-scrollbar/perfect-scrollbar.css"/>
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
                                        <a href="category">หมวดหมู่พืช</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="active">แก้ไขข้อมูล</a>
                                    </li>
                                </ol>
                            </nav>

                            <span class="active-menu-url">category</span>
                            <!-- /Breadcrumb & Active menu-->

                            <?php
                                if(!isset($_GET["tagID"])){
                                    echo "<script>window.location.href='category';</script>";
                                    exit();
                                }else{
                                    $tagID = $_GET["tagID"];

                                    $sql = "SELECT tagID, tagName
                                            FROM categories
                                            WHERE tagID = ?
                                            LIMIT 1;";
                                    
                                    $stmt = $database->prepare($sql);
                                    $stmt->bind_param('s', $tagID);
                                    $stmt->execute();
                                    $categoryResult = $stmt-> get_result();
                                    $stmt->close();
                                    $category = $categoryResult->fetch_assoc();
                                }
                            ?>

                            <div class="row g-3">
                                <!-- Card form -->
                                <div class="col-12">
                                    <div class="card mb-4">
                                        <h5 class="card-header">
                                            <i class="fa-regular fa-rectangle-list me-1"></i>
                                            แก้ไขข้อมูลหมวดหมู่
                                        </h5>
                                        <div class="card-body">
                                            <form id="formEditCategory" method="post" action="../data/category/updateCategory">
                                                <div class="row g-2">
                                                    <input type="hidden" name="tagID" value="<?php echo $category["tagID"]; ?>">
                                                    <div class="col-12">
                                                        ชื่อหมวดหมู่พืช
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="fa-regular fa-comment"></i></span>
                                                            <input type="text" name="tagName" class="form-control" placeholder="ระบุชื่อหมวดหมู่" autofocus autocomplete="off" required
                                                            value="<?php echo $category["tagName"]; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-primary me-2">บันทึกข้อมูล</button>
                                                    <a href="category" class="btn btn-label-secondary">ย้อนกลับ</a>
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
            $('#formEditCategory').submit(function(e) {
                e.preventDefault();
                var form = $(this);

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
                                    window.location.href="category";
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
        </script>
    </body>
</html>