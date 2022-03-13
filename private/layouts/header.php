<header>
  <nav class="navbar navbar-expand-md navbar-light d-none d-md-flex">
    <div class="container-fluid">
      <a class="navbar-brand mr-auto" href="/yonetim-paneli">
      </a>
      <div class="navbar-user">

        <div class="d-flex mr-4">
          <a href="/" class="text-muted" rel="external" data-toggle="tooltip" data-placement="bottom" title="Siteyi Görüntüle">
            <i class="fe fe-home"></i>
          </a>
        </div>

        <div class="d-flex mr-4">
          <a href="#modalCustomize" class="text-muted" data-toggle="modal">
            <div data-toggle="tooltip" data-placement="bottom" title="Tema Ayarları">
              <i class="fe fe-sliders"></i>
            </div>
          </a>
        </div>


        <!-- Dropdown -->
        <div class="dropdown mr-4 d-none d-lg-flex">
          <!-- Toggle -->
          <a href="#" class="text-muted" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="icon <?php echo (($notificationsUnreadeds->rowCount() > 0) || (($needUpdate == true && $readAdmin["permission"] == 1))) ? "active" : null; ?>">
              <i class="fe fe-bell"></i>
            </span>
          </a>
          <!-- Menu -->
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col">
                  <!-- Title -->
                  <h5 class="card-header-title">
                    Bildirimler
                  </h5>
                </div>
                <div class="col-auto">
                  <!-- Link -->
                  <a href="/yonetim-paneli/bildirimler" class="small">
                    Tümü
                  </a>
                </div>
              </div> <!-- / .row -->
            </div> <!-- / .card-header -->
            <div class="card-body px-0">
              <!-- List group -->
              <div class="list-group list-group-flush my-n3">
                <?php if ($needUpdate == true && $readAdmin["permission"] == 1): ?>
                  <div class="list-group-item px-4">
                    <div class="row">
                      <div class="col-auto d-flex align-items-center">
                        <!-- Avatar -->
                        <div class="avatar avatar-sm d-flex align-items-center">
                          <i class="fe fe-alert-circle" style="font-size: 32px;"></i>
                        </div>
                      </div>
                <?php endif; ?>
                <?php
                  if ($readAdmin["permission"] == 1 || $readAdmin["permission"] == 2 || $readAdmin["permission"] == 3) {
                    $types = array(1, 2, 3, 4);
                  }
                  else if ($readAdmin["permission"] == 4) {
                    $types = array(2);
                  }
                  else if ($readAdmin["permission"] == 5) {
                    $types = array(1);
                  }
                  else {
                    $types = array(null);
                  }
                  $questionMarks = rtrim(str_repeat("?,", count($types)), ",");
                  array_push($types, ($readAdmin["lastReadDate"]) ? $readAdmin["lastReadDate"] : '1000-01-01 00:00:00');
                  $notifications = $db->prepare("SELECT N.*, A.realname FROM Notifications N INNER JOIN Accounts A ON N.accountID = A.id WHERE N.type in ($questionMarks) AND N.creationDate > ? ORDER BY N.id DESC LIMIT 5");
                  $notifications->execute($types);
                ?>
                <?php if ($notifications->rowCount() > 0): ?>
                  <?php foreach ($notifications as $readNotifications): ?>
                    <a class="notification-block list-group-item px-4" href="<?php echo (($readNotifications["type"] == 1) ? "/yonetim-paneli/destek/goruntule/".$readNotifications["variables"] : (($readNotifications["type"] == 2) ? "/yonetim-paneli/haber/yorum/duzenle/".$readNotifications["variables"] : "#")) ?>">
                      <div class="row">
                        <div class="col-auto">
                          <!-- Avatar -->
                          <div class="avatar avatar-sm">
                            <?php echo minecraftHead($readSettings["avatarAPI"], $readNotifications["realname"], 32, "avatar-img"); ?>
                          </div>
                        </div>
                        <div class="col ml-n2">
                          <!-- Content -->
                          <div class="small text-muted">
                            <strong class="text-primary"><?php echo $readNotifications["realname"]; ?> </strong>
                            <?php if ($readNotifications["type"] == 1): ?>
                              destek mesajı gönderdi!
                            <?php elseif ($readNotifications["type"] == 2): ?>
                              habere yorum yaptı!
                            <?php elseif ($readNotifications["type"] == 3): ?>
                              <?php echo $readNotifications["variables"]; ?> Rivalet yükledi!
                            <?php elseif ($readNotifications["type"] == 4): ?>
                              <?php $readNotifications["variables"] = explode(",", $readNotifications["variables"]); ?>
                              <?php echo $readNotifications["variables"][0]; ?> <?php echo $readNotifications["variables"][1]; ?> ürünü satın aldı!
                            <?php else: ?>
                              HATA!
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col-auto">
                          <small class="text-muted">
                            <?php echo convertTime($readNotifications["creationDate"]); ?>
                          </small>
                        </div>
                      </div> <!-- / .row -->
                    </a>
                  <?php endforeach; ?>
                <?php else: ?>
                  <?php if ($readAdmin["permission"] == 1): ?>
                    <?php if ($needUpdate == false): ?>
                      <span class="text-muted text-center">Size ait bildirim bulunmamaktadır.</span>
                    <?php endif; ?>
                  <?php else: ?>
                    <span class="text-muted text-center">Size ait bildirim bulunmamaktadır.</span>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          </div> <!-- / .dropdown-menu -->
        </div>

        <div class="dropdown">
          <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="clearfix">
              <div class="account-img avatar avatar-sm avatar-online float-left mr-2">
                <?php echo minecraftHead($readSettings["avatarAPI"], $readAdmin["realname"], 40, "avatar-img"); ?>
              </div>
              <div class="account-info float-left">
                <span class="account-username"><?php echo $readAdmin["realname"]; ?></span>
                <span class="account-position">
                  <?php if ($readAdmin["permission"] == 1): ?>
                    Yönetici
                  <?php elseif ($readAdmin["permission"] == 2): ?>
                    Moderatör
                  <?php elseif ($readAdmin["permission"] == 3): ?>
                    Görevli
                  <?php elseif ($readAdmin["permission"] == 4): ?>
                    Yazar
                  <?php elseif ($readAdmin["permission"] == 5): ?>
                    Destek
                  <?php else: ?>
                    HATA!
                  <?php endif; ?>
                </span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a href="/yonetim-paneli/hesap/goruntule/<?php echo $readAdmin["id"]; ?>" class="dropdown-item">
              <i class="fe fe-user mr-2"></i> Profil
            </a>
            <a href="/yonetim-paneli/ayarlar/genel" class="dropdown-item">
              <i class="fe fe-settings mr-2"></i> Ayarlar
            <hr class="dropdown-divider">
            <a class="dropdown-item" href="/cikis-yap">
              <i class="fe fe-power mr-2"></i> Çıkış Yap
            </a>
            </a>
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header>
