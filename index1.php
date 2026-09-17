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
    <title>AdminLTE 4 | Users</title>

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
    <meta name="title" content="AdminLTE 4 | Users" />
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
    <link rel="preload" href="cdnjs.cloudflare.com/ajax/libs/admin-lte/4.0.0/css/adminlte.min.css" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media = 'all'"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/2.11.0/css/OverlayScrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/4.0.0/css/adminlte.min.css" />
    <!--end::Required Plugin(AdminLTE)-->
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
 
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3">ข้อมูลห้อง</h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="frm_add_room_type1.php">ประเภทห้อง</a></li>
                    <li class="breadcrumb-item"><a href="frm_add_floor1.php">ชั้น</a></li>
                    <li class="breadcrumb-item"><a href="users.php">ผู้ใช้</a></li>
                  </ol>
                </nav>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-12">
                <!--begin::Card-->
                <div class="card mb-4">
                  <!--begin::Card Header-->
                  <div class="card-header">
                    <div class="row g-2 align-items-center">
                      <div class="col-12 col-md-4">
                        <h3 class="card-title">ข้อมูลห้อง</h3>
                      </div>
                      <div class="col-12 col-md-8">
                        <div class="d-flex flex-wrap justify-content-md-end gap-2">
                          <div class="input-group input-group-sm w-auto">
                            <span class="input-group-text">
                              <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input
                              type="search"
                              id="user-search"
                              class="form-control"
                              placeholder="Search users"
                              aria-label="Search users"
                              style="width: 180px"
                            />
                          </div>
                          <select
                            id="user-role-filter"
                            class="form-select form-select-sm w-auto"
                            aria-label="Filter by role"
                          >
                            <option value="all" selected>All roles</option>
                            <option value="administrator">Administrator</option>
                            <option value="editor">Editor</option>
                            <option value="author">Author</option>
                            <option value="subscriber">Subscriber</option>
                          </select>
                          <button
                            type="button"
                            class="btn btn-sm btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#addRoomDataModal"
                          >
                            <i class="bi bi-person-plus-fill me-1" aria-hidden="true"> </i>
                            เพิ่มข้อมูลห้อง
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end::Card Header-->
                  <!--begin::Card Body-->
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
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                  <!--end::Card Body-->
                  <!--begin::Card Footer-->
                  <div class="card-footer clearfix">
                    <div class="float-start pt-1 fs-7 text-body-secondary">
                      Showing 1 to 9 of 42 users
                    </div>
                    <ul class="pagination pagination-sm m-0 float-end">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous"> &laquo; </a>
                      </li>
                      <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">3</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">4</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">5</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next"> &raquo; </a>
                      </li>
                    </ul>
                  </div>
                  <!--end::Card Footer-->
                </div>
                <!--end::Card-->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->

            <!--begin::Add User Modal-->
            <div
              class="modal fade"
              id="modal-add-user"
              tabindex="-1"
              aria-labelledby="modal-add-user-label"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <form>
                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-add-user-label">Add new user</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="new-user-name" class="form-label"> Full name </label>
                        <input
                          type="text"
                          class="form-control"
                          id="new-user-name"
                          placeholder="e.g. Jane Doe"
                          required
                        />
                      </div>
                      <div class="mb-3">
                        <label for="new-user-email" class="form-label"> Email address </label>
                        <input
                          type="email"
                          class="form-control"
                          id="new-user-email"
                          placeholder="name@example.com"
                          required
                        />
                        <div class="form-text">The invitation will be sent to this address.</div>
                      </div>
                      <div class="mb-3">
                        <label for="new-user-role" class="form-label"> Role </label>
                        <select id="new-user-role" class="form-select">
                          <option selected>Subscriber</option>
                          <option>Author</option>
                          <option>Editor</option>
                          <option>Administrator</option>
                        </select>
                      </div>
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          id="new-user-welcome"
                          checked
                        />
                        <label class="form-check-label" for="new-user-welcome">
                          Send a welcome email with login details
                        </label>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                      </button>
                      <button type="submit" class="btn btn-primary">Create user</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!--end::Add User Modal-->

            <!--begin::Delete User Modal-->
            <div
              class="modal fade"
              id="modal-delete-user"
              tabindex="-1"
              aria-labelledby="modal-delete-user-label"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modal-delete-user-label">Delete user</h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    ></button>
                  </div>
                  <div class="modal-body">
                    <p class="mb-0">
                      Are you sure you want to delete this user? All content owned by the account
                      will be reassigned to the site administrator. This action cannot be undone.
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                      Cancel
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                      Delete user
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!--end::Delete User Modal-->
          </div>
          <!--end::Container-->
        </div>
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
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0/dist/js/adminlte.min.js"></script>
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

    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
