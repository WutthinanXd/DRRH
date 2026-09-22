<?php
    include "config/connectDB.php";
    $sql = "SELECT
    tb_roomdata.room_id,
    tb_roomdata.room_number,
    tb_roomdata.room_name,
    tb_roomdata.room_description,
    tb_roomdata.floor_id,
    tb_floors.floor_name,
    tb_roomdata.room_seats,
    tb_roomdata.room_type_id,
    tb_room_types.room_type_name,
    tb_room_types.room_type_status,
    tb_roomdata.room_status 
FROM
    tb_roomdata
    LEFT JOIN tb_room_types ON tb_roomdata.room_type_id = tb_room_types.room_type_id
    LEFT JOIN tb_floors ON tb_roomdata.floor_id = tb_floors.floor_id";
    $result = mysqli_query($conn, $sql);
$sqlroomtype = "SELECT * FROM tb_room_types ORDER BY room_type_id DESC";
$resultroomtype = mysqli_query($conn, $sqlroomtype);
$sqlflo = "SELECT * FROM tb_floors ORDER BY floor_id";
$resultflo = mysqli_query($conn, $sqlflo);

?>

<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE v4 | Dashboard</title>

    <!--begin::Theme Init (prevents flash of incorrect theme on load, #6043)-->
    <script>
      (() => {
        'use strict';
        const root = document.documentElement;

        // Applications with their own theming opt out of AdminLTE's color mode
        // entirely, here as well as in the bundle.
        if (root.getAttribute('data-lte-color-mode') === 'off') {
          return;
        }

        const STORAGE_KEY = 'lte-theme';
        let stored = null;
        try {
          stored = localStorage.getItem(STORAGE_KEY);
        } catch {
          // localStorage may be unavailable (private mode, sandboxed iframe).
        }
        // Mirror the precedence in color-mode.ts: the visitor's stored choice
        // wins, then a theme this page declared itself, then the OS preference.
        const authored = root.getAttribute('data-bs-theme');
        let resolved = 'light';
        if (stored === 'dark' || stored === 'light') {
          resolved = stored;
        } else if (authored === 'dark' || authored === 'light') {
          resolved = authored;
        } else if (globalThis.matchMedia('(prefers-color-scheme: dark)').matches) {
          resolved = 'dark';
        }
        root.setAttribute('data-bs-theme', resolved);
        root.style.colorScheme = resolved;
        // Flag values computed here, so the bundle does not mistake them for a
        // theme the page declared and stop following the OS preference.
        if (resolved !== authored) {
          root.setAttribute('data-lte-theme-resolved', '');
        }
      })();
    </script>
    <!--end::Theme Init-->

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a free Bootstrap 5 admin dashboard template with almost 50 example pages, built with vanilla JS and designed with accessibility in mind."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel"
    />
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="./css/adminlte.css" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media = 'all'"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="./node_modules/admin-lte/dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->

    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />

    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous"
    />
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a
                class="nav-link"
                data-lte-toggle="sidebar"
                href="#"
                role="button"
                aria-label="Toggle sidebar"
              >
                <i class="bi bi-list"></i>
              </a>
            </li>

            
          </ul>
          <!--end::Start Navbar Links-->

          <!--begin::Navbar Search-->

          </form>
          <!--end::Navbar Search-->

          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Search (small screens: the field above is hidden, so link to the search page)-->
            <li class="nav-item d-md-none">
              <a class="nav-link" href="./pages/search-results.html" aria-label="Search">
                <i class="bi bi-search" aria-hidden="true"></i>
              </a>
            </li>
            <!--end::Search-->
            <!--begin::Messages Dropdown Menu-->
            

            

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="./dist/assets/img/user2-160x160.jpg"
                  class="user-image rounded-circle shadow"
                  alt="Alexander Pierce"
                />
                <span class="d-none d-md-inline">Alexander Pierce</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="./assets/img/user2-160x160.jpg"
                    class="rounded-circle shadow"
                    alt="Alexander Pierce"
                  />
                  <p>
                    Alexander Pierce - Web Developer
                    <small>Member since Nov. 2023</small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
                <li class="user-body">
                  <!--begin::Row-->
                  <div class="row">
                    <div class="col-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div>
                  <!--end::Row-->
                </li>
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="#" class="btn btn-outline-secondary">Profile</a>
                  <a href="#" class="btn btn-outline-danger float-end">Sign out</a>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
      <?php include 'include/aside.php' ;?>      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Dashboard</h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    
                     <button
                            type="button"
                            class="btn btn-sm btn-outline-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#addRoomDataModal"
                          >
                            <i class="bi bi-building-fill-add me-1" aria-hidden="true"> </i>
                            เพิ่มข้อมูลห้อง
                          </button>
                  </ol>
                </nav>
              </div>
            </div>
            <!--begin::Row-->
            
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!-- Small Box (Stat card) -->
            
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box text-bg-primary">
                  <div class="inner">
                    <h3>150</h3>

                    <p>New Orders</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"
                    ></path>
                  </svg>
                  <a
                    href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box text-bg-success">
                  <div class="inner">
                    <h3>53<sup class="fs-5">%</sup></h3>

                    <p>Bounce Rate</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"
                    ></path>
                  </svg>
                  <a
                    href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box text-bg-warning">
                  <div class="inner">
                    <h3>44</h3>

                    <p>User Registrations</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"
                    ></path>
                  </svg>
                  <a
                    href="#"
                    class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box text-bg-danger">
                  <div class="inner">
                    <h3>65</h3>

                    <p>Unique Visitors</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
                    ></path>
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
                    ></path>
                  </svg>
                  <a
                    href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <!-- /.row -->
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        
        
        <!--end::App Content Header-->
         <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-hover align-middle m-0">
                        <thead>
                          <tr>
                            <th>รหัส</th>
                            <th>หมายเลขห้อง</th>
                            <th>ชื่อห้อง</th>
                            <th>รายละเอียด</th>
                            <th>ชั้น</th>
                            <th>จำนวนที่นั่ง</th>
                            <th>ประเภทห้อง</th>
                            <th>สถานะ</th>
                            <th class="text-end">จัดการ</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                           <?php $i=0; ?>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <?php $i++; ?>
        <tr>
            <td class="text-center"><?= $i; ?></td>

            <td>
                <?= $row["room_number"] ?>
            </td>

            <td>
                <?= $row["room_name"] ?>
            </td>

            <td>
                <?= $row["room_description"] ?>
            </td>

            <td>
                <?= $row["floor_name"] ?>
            </td>

            <td>
                <?= $row["room_seats"] ?>
            </td>

            <td>

                <?= $row["room_type_name"]; ?>


            </td>

            <td>

                <?php

                if ($row["room_status"] == 1) {
                    echo "พร้อมใช้งาน";
                } else {
                    echo "ไม่พร้อมใช้งาน";
                }

                ?>

            </td>

            <td class="text-end">
            <div class ="btn-group btn-group-sm">
                <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRoomModal<?= $row['room_id'] ?>">
                    <i class="bi bi-pencil"></i></button>

                
                    <a
                    href="delete_room_data.php?id=<?= $row["room_id"] ?>"
                    class="btn btn-outline-danger btn-sm"
                    onclick="return confirm('ต้องการลบข้อมูลนี้หรือไม่?')"
                >
                    <i class="bi bi-trash"></i>
                   </a>                  
                   </div>    
                    <div class="modal fade" id="editRoomModal<?= $row["room_id"] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog text-start">
                            <div class="modal-content">
                                <form action="update_room_data.php" method="post">
                                    <input type="hidden" name="room_id" value="<?= $row["room_id"] ?>"> 
                                    <div class="modal-header">
                                    <h2 class="modal-title fs-5"><i class="fa fa-edit me-2"></i> แก้ไขข้อมูลห้อง</h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="mb-3">
                                    <label class="form-label">หมายเลขห้อง</label>
                                    <input type="text" name="room_number" class="form-control" 
                                                   value="<?= ($row["room_number"]) ?>" required>
                                    </div>  
                                     <div class="mb-3">
                                     <label class="form-label">ชื่อห้อง</label>
                                    <input type="text" name="room_name" class="form-control" 
                                                   value="<?= ($row["room_name"]) ?>" required>
                                    </div>
                                    <div class="mb-3">
                                            <label class="form-label">คำอธิบาย</label>
                                            <textarea name="room_description" class="form-control"><?=($row["room_description"]) ?></textarea>
                                    </div>    
                                    <div class="row">                                    
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">ชั้น</label>
                                            <select name="floor_id" class="form-select" required>
                                                <?php 
                                                $floors = mysqli_query($conn,"SELECT * FROM tb_floors ORDER BY floor_id ASC");
                                                while ($floor = mysqli_fetch_assoc($floors)) { ?>
                                                    <option value="<?= $floor["floor_id"] ?>" <?= ($floor["floor_id"] == $row["floor_id"]) ? 'selected' : '' ?>>
                                                        <?= ($floor["floor_name"]) ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                                                             
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">จำนวนที่นั่ง</label>
                                            <input type="number" name="room_seats" class="form-control" 
                                                   value="<?= $row["room_seats"] ?>" required>
                                        </div>
                                    </div>

                                        <div class="mb-3">
                                        <label class="form-label">ประเภทห้อง</label>
                                        <select name="room_type_id" class="form-select" required>
                                         <?php 
                                        $roomtypes = mysqli_query($conn,"SELECT * FROM tb_room_types ORDER BY room_type_id DESC");
                                        while ($type = mysqli_fetch_assoc($roomtypes)) { ?>
                                        <option value="<?= $type["room_type_id"] ?>" <?= ($type["room_type_id"] == $row["room_type_id"]) ? 'selected' : '' ?>>
                                        <?= ($type["room_type_name"]) ?>
                                        </option>
                                        <?php } ?>
                                        </select>
                                        </div>
                                        <div class="mb-3">
                                        <label class="form-label">สถานะ</label>
                                        <select name="room_status" class="form-select">
                                        <option value="1" <?= ($row["room_status"] == 1) ? 'selected' : '' ?>>พร้อมใช้งาน</option>
                                        <option value="0" <?= ($row["room_status"] == 0) ? 'selected' : '' ?>>ไม่พร้อมใช้งาน</option>
                                        </select>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i> บันทึกการแก้ไข</button>
                                    </div>
                             </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    <?php } ?>
</table>
<div class="modal fade" id="addRoomDataModal" tabindex="-1" aria-labelledby="addRoomDataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="save_room_data.php" method="post">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="addRoomDataModalLabel">เพิ่มข้อมูลห้อง</h2><button
                            type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"><label for="add-room-name"
                                class="form-label">หมายเลขห้อง</label><input id="add-room-name" type="text"
                                name="room_number" class="form-control" required></div>
                        <div class="mb-3"><label for="add-room-name"
                                class="form-label">ชื่อห้อง</label><input id="add-room-name" type="text"
                                name="room_name" class="form-control" required></div>
                        <label for="add-room-description" class="form-label">คำอธิบาย</label>
                        <textarea id="add-room-description" name="room_description" class="form-control"></textarea>
                        <label for="add-floor-id" class="form-label">ชั้น</label>
                        <select id="add-floor-id" name="floor_id" class="form-select">
                            <?php while ($rowflo = mysqli_fetch_assoc($resultflo)) { ?>
                                <option value="<?= $rowflo["floor_id"] ?>"><?= $rowflo["floor_name"] ?></option>
                            <?php } ?>
                        </select>
                        <label for="add-room-seats" class="form-label">จำนวนที่นั่ง</label>
                        <input id="add-room-seats" type="number" name="room_seats" class="form-control" required>
                        <label for="add-room-type-id" class="form-label">ประเภทห้อง</label>
                        <select id="add-room-type-id" name="room_type_id" class="form-select">
                            <?php while ($rowroomtype = mysqli_fetch_assoc($resultroomtype)) { ?>
                                <option value="<?= $rowroomtype["room_type_id"] ?>"><?= $rowroomtype["room_type_name"] ?></option>
                            <?php } ?>
                        </select>
                        <label for="add-room-status" class="form-label">สถานะ</label>
                        <select id="add-room-status" name="room_status" class="form-select">
                            <option value="1">พร้อมใช้งาน</option>
                            <option value="0">ไม่พร้อมใช้งาน</option>
                        </select>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">ยกเลิก</button><button type="submit"
                            class="btn btn-primary">บันทึก</button></div>
                </form>
            </div>
        </div>
    </div> 
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2014-2026&nbsp;
          <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="./node_modules/admin-lte/dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)-->
    <!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

        // Disable OverlayScrollbars on mobile devices to prevent touch interference
        const isMobile = window.innerWidth <= 992;

        if (
          sidebarWrapper &&
          OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
          !isMobile
        ) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--begin::Charts follow the colour mode-->
    <script>
      // ApexCharts draws light-theme tooltips and axis text unless told otherwise,
      // which is unreadable in dark mode (#6105). Give it the page's colour mode as
      // a global default before any chart is created — this runs before the chart
      // pages' own scripts — and keep every chart that has a `chart.id` in step
      // when the mode changes (ColorMode, the OS in auto mode, or your own code).
      (() => {
        'use strict';
        const mode = () =>
          document.documentElement.getAttribute('data-bs-theme') === 'dark' ? 'dark' : 'light';
        // `Apex` is ApexCharts' global-options object; it must exist before the library loads.
        // theme.mode also sets a dark chart background — keep the card's instead.
        // eslint-disable-next-line unicorn/no-global-object-property-assignment
        globalThis.Apex ||= {};
        const apex = globalThis.Apex;
        apex.theme = { mode: mode() };
        apex.chart = Object.assign(apex.chart || {}, { background: 'transparent' });
        new MutationObserver(() => {
          const next = mode();
          apex.theme = { mode: next };
          const instances = apex._chartInstances || [];
          for (const { chart } of instances) {
            chart.updateOptions({ theme: { mode: next } }, false, false);
          }
        }).observe(document.documentElement, {
          attributes: true,
          attributeFilter: ['data-bs-theme'],
        });
      })();
    </script>
    <!--end::Charts follow the colour mode-->

    <!--begin::Color Mode Toggle-->
    <!-- The light/dark/auto switcher ships in adminlte.js as the ColorMode
     module (since 4.1) — no page script needed. Only the no-flash snippet
     in <head> stays inline, because it must run before first paint. -->
    <!--end::Color Mode Toggle-->

    <!-- OPTIONAL SCRIPTS -->

    <!-- sortablejs -->
    <script
      src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
      crossorigin="anonymous"
    ></script>
    <!-- sortablejs -->
    <script>
      new Sortable(document.querySelector('.connectedSortable'), {
        group: 'shared',
        handle: '.card-header',
      });

      const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
      cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = 'move';
      });
    </script>
    <!-- apexcharts -->
    <script
      src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
      integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
      crossorigin="anonymous"
    ></script>
    <!-- ChartJS -->
    <script>
      // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
      // IT'S ALL JUST JUNK FOR DEMO
      // ++++++++++++++++++++++++++++++++++++++++++

      const sales_chart_options = {
        series: [
          {
            name: 'Digital Goods',
            data: [28, 48, 40, 19, 86, 27, 90],
          },
          {
            name: 'Electronics',
            data: [65, 59, 80, 81, 56, 55, 40],
          },
        ],
        chart: {
          id: 'revenue-chart',
          height: 300,
          type: 'area',
          toolbar: {
            show: false,
          },
        },
        legend: {
          show: false,
        },
        colors: ['#0d6efd', '#20c997'],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth',
        },
        xaxis: {
          type: 'datetime',
          categories: [
            '2023-01-01',
            '2023-02-01',
            '2023-03-01',
            '2023-04-01',
            '2023-05-01',
            '2023-06-01',
            '2023-07-01',
          ],
        },
        tooltip: {
          x: {
            format: 'MMMM yyyy',
          },
        },
      };

      const sales_chart = new ApexCharts(
        document.querySelector('#revenue-chart'),
        sales_chart_options,
      );
      sales_chart.render();
    </script>
    <!-- jsvectormap -->
    <script
      src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
      integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
      integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY="
      crossorigin="anonymous"
    ></script>
    <!-- jsvectormap -->
    <script>
      // World map by jsVectorMap
      new jsVectorMap({
        selector: '#world-map',
        map: 'world',
      });

      // Sparkline charts
      const option_sparkline1 = {
        series: [
          {
            data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
          },
        ],
        chart: {
          id: 'sparkline-1',
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
      sparkline1.render();

      const option_sparkline2 = {
        series: [
          {
            data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
          },
        ],
        chart: {
          id: 'sparkline-2',
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
      sparkline2.render();

      const option_sparkline3 = {
        series: [
          {
            data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
          },
        ],
        chart: {
          id: 'sparkline-3',
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
      sparkline3.render();
    </script>
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
