<?php
  $notificationsUnreadeds = $db->prepare("SELECT id FROM Notifications WHERE creationDate > ? ORDER BY id LIMIT 100");
  $notificationsUnreadeds->execute(array((($readAdmin["lastReadDate"]) ? $readAdmin["lastReadDate"] : '1000-01-01 00:00:00')));
?>
<!-- Modal: Customize -->
<div class="modal fade fixed-right" id="modalCustomize" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-vertical" role="document">
    <form class="modal-content" id="themeForm">
      <div class="modal-body">
        <!-- Close -->
        <a class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
        <h2 class="text-center mb-2">
          Tema Ayarları
        </h2>
        <hr class="mb-4">
        <h4 class="mb-1">
          Tema
        </h4>
        <p class="small text-muted mb-3">
          Tema seçimini buradan yapabilirsiniz.
        </p>
        <div class="btn-group-toggle d-flex mb-4" data-toggle="buttons">
          <label class="btn btn-white active col">
            <input type="radio" name="colorScheme" id="colorSchemeLight" value="light"><i class="fe fe-sun mr-2"></i> Light Tema
          </label>
          <label class="btn btn-white col ml-2">
            <input type="radio" name="colorScheme" id="colorSchemeDark" value="dark"><i class="fe fe-moon mr-2"></i> Dark Tema
          </label>
        </div>
        <input type="radio" id="navPositionCombo" class="d-none" name="navPosition" value="combo" checked>
        <input type="radio" id="sidebarColorDefault" class="d-none" name="sidebarColor" value="default" checked>
      </div>

      <div class="modal-footer border-0">
        <button type="submit" class="btn btn-block btn-success mt-auto">
          Değişiklikleri Kaydet
        </button>
      </div>
    </form>
  </div>
</div>
<nav id="navbar" class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light">
  <div class="container-fluid">
    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Brand -->
    <a class="navbar-brand" href="/yonetim-paneli">
      <img class="justify-content-center text-align-center m-auto" src="/apps/main/public/assets/img/extras/header-logo.png">
    </a>
    <!-- User (xs) -->
    <div class="navbar-user d-md-none">
      <!-- Dropdown -->
      <div class="dropdown">
        <!-- Toggle -->
        <a href="#!" id="sidebarIcon" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="avatar avatar-sm avatar-online">
            <?php echo minecraftHead($readSettings["avatarAPI"], $readAdmin["realname"], 40, "avatar-img"); ?>
          </div>
        </a>
        <!-- Menu -->
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sidebarIcon">
          <a href="/yonetim-paneli/hesap/goruntule/<?php echo $readAdmin["id"]; ?>" class="dropdown-item">
            <i class="fe fe-user mr-2"></i> Profil
          </a>
            <i class="fe fe-bell mr-2"></i> Bildirimler (<?php echo (($notificationCount > 99) ? '99+' : $notificationCount); ?>)
          </a>
          <a href="/yonetim-paneli/ayarlar/genel" class="dropdown-item">
            <i class="fe fe-settings mr-2"></i> Ayarlar
          </a>
          <hr class="dropdown-divider">
          <a href="/" rel="external" class="dropdown-item">
            <i class="fe fe-home mr-2"></i> Siteyi Görüntüle
          </a>
          <a href="#modalCustomize" class="dropdown-item" data-toggle="modal">
            <i class="fe fe-sliders mr-2"></i> Kişiselleştir
          </a>
          <hr class="dropdown-divider">
          <a href="/cikis-yap" class="dropdown-item">
            <i class="fe fe-power mr-2"></i> Çıkış
          </a>
        </div>
      </div>
    </div>
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidebarCollapse">
      <!-- Navigation -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php echo (get("route") == "home") ? "active" : null; ?>" href="/yonetim-paneli">
            <i class="fe fe-activity"></i> Riva Network Yönetim Paneli
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarNews" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-edit"></i> Haber
          </a>
          <div class="collapse <?php echo (get("route") == "news") ? "show" : null; ?>" id="sidebarNews">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/haber" class="nav-link <?php echo ((get("route") == "news") && (get("target") == "news") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Haberler
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/haber/ekle" class="nav-link <?php echo ((get("route") == "news") && (get("target") == "news") && (get("action") == "insert")) ? "active" : null; ?>">
                  Haber Ekle
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/haber/kategori" class="nav-link <?php echo ((get("route") == "news") && (get("target") == "category") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Kategoriler
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/haber/kategori/ekle" class="nav-link <?php echo ((get("route") == "news") && (get("target") == "category") && (get("action") == "insert")) ? "active" : null; ?>">
                  Kategori Ekle
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/haber/yorum" class="nav-link <?php echo ((get("route") == "news") && (get("target") == "comment") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Yorumlar
                  <?php
                    $unconfirmedNewsComments = $db->prepare("SELECT id FROM NewsComments WHERE status = ?");
                    $unconfirmedNewsComments->execute(array(0));
                  ?>
                  <?php if ($unconfirmedNewsComments->rowCount() > 0): ?>
                    <span class="badge badge-primary rounded-pill ml-auto"><?php echo $unconfirmedNewsComments->rowCount(); ?></span>
                  <?php endif; ?>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarGame" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-play-circle"></i> Oyun
          </a>
          <div class="collapse <?php echo (get("route") == "game") ? "show" : null; ?>" id="sidebarGame">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/oyun" class="nav-link <?php echo ((get("route") == "game") && (get("target") == "game") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Oyunlar
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/oyun/ekle" class="nav-link <?php echo ((get("route") == "game") && (get("target") == "game") && (get("action") == "insert")) ? "active" : null; ?>">
                  Oyun Ekle
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarServer" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-server"></i> Sunucu
          </a>
          <div class="collapse <?php echo (get("route") == "server") ? "show" : null; ?>" id="sidebarServer">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/sunucu" class="nav-link <?php echo ((get("route") == "server") && (get("target") == "server") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Sunucular
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/sunucu/ekle" class="nav-link <?php echo ((get("route") == "server") && (get("target") == "server") && (get("action") == "insert")) ? "active" : null; ?>">
                  Sunucu Ekle
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarStore" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-shopping-cart"></i> Market
          </a>
          <div class="collapse <?php echo (get("route") == "store") ? "show" : null; ?>" id="sidebarStore">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/magaza/urun" class="nav-link <?php echo ((get("route") == "store") && (get("target") == "product") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Ürünler
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/magaza/urun/ekle" class="nav-link <?php echo ((get("route") == "store") && (get("target") == "product") && (get("action") == "insert")) ? "active" : null; ?>">
                  Ürün Ekle
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/magaza/kategori" class="nav-link <?php echo ((get("route") == "store") && (get("target") == "category") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Kategoriler
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/magaza/kategori/ekle" class="nav-link <?php echo ((get("route") == "store") && (get("target") == "category") && (get("action") == "insert")) ? "active" : null; ?>">
                  Kategori Ekle
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/magaza/kupon" class="nav-link <?php echo ((get("route") == "store") && (get("target") == "coupon") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Kuponlar
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/magaza/kupon/ekle" class="nav-link <?php echo ((get("route") == "store") && (get("target") == "coupon") && (get("action") == "insert")) ? "active" : null; ?>">
                  Kupon Ekle
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/magaza/kredi/gonder" class="nav-link <?php echo ((get("route") == "store") && (get("target") == "credit") && (get("action") == "send")) ? "active" : null; ?>">
                  Rivalet Gönder
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/magaza/esya/gonder" class="nav-link <?php echo ((get("route") == "store") && (get("target") == "chest") && (get("action") == "send")) ? "active" : null; ?>">
                  Eşya Gönder
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/magaza/toplu-indirim" class="nav-link <?php echo ((get("route") == "store") && (get("target") == "discount") && (get("action") == "update")) ? "active" : null; ?>">
                  Toplu İndirim
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/magaza/sandik-gecmisi" class="nav-link <?php echo ((get("route") == "store") && (get("target") == "chest-history") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Sandık Geçmişi
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/magaza/kupon-gecmisi" class="nav-link <?php echo ((get("route") == "store") && (get("target") == "coupon-history") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Kupon Geçmişi
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/magaza/kredi-yukleme-gecmisi" class="nav-link <?php echo ((get("route") == "store") && (get("target") == "credit-charge-history") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Rivalet Yükleme Geçmişi
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/magaza/kredi-kullanim-gecmisi" class="nav-link <?php echo ((get("route") == "store") && (get("target") == "credit-usage-history") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Rivalet Kullanım Geçmişi
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/magaza/magaza-gecmisi" class="nav-link <?php echo ((get("route") == "store") && (get("target") == "store-history") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Market Geçmişi
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarGift" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-gift"></i> Hediye
          </a>
          <div class="collapse <?php echo (get("route") == "gift") ? "show" : null; ?>" id="sidebarGift">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/hediye" class="nav-link <?php echo ((get("route") == "gift") && (get("target") == "gift") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Hediyeler
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/hediye/ekle" class="nav-link <?php echo ((get("route") == "gift") && (get("target") == "gift") && (get("action") == "insert")) ? "active" : null; ?>">
                  Hediye Ekle
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/hediye/hediye-gecmisi" class="nav-link <?php echo ((get("route") == "gift") && (get("target") == "gift-history") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Hediye Geçmişi
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarAccount" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-users"></i> Hesap
          </a>
          <div class="collapse <?php echo (get("route") == "account") ? "show" : null; ?>" id="sidebarAccount">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/hesap" class="nav-link <?php echo ((get("route") == "account") && (get("target") == "account") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Hesaplar
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/hesap/ekle" class="nav-link <?php echo ((get("route") == "account") && (get("target") == "account") && (get("action") == "insert")) ? "active" : null; ?>">
                  Hesap Ekle
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/hesap/yetkili" class="nav-link <?php echo ((get("route") == "account") && (get("target") == "authorized") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Yetkili Hesaplar
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarSupport" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-life-buoy"></i> Destek
          </a>
          <div class="collapse <?php echo (get("route") == "support") ? "show" : null; ?>" id="sidebarSupport">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/destek" class="nav-link <?php echo ((get("route") == "support") && (get("target") == "support") && (get("category") == false) && (get("action") == "getAll")) ? "active" : null; ?>">
                  Tümü
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/destek/yanit-bekleyen" class="nav-link <?php echo ((get("route") == "support") && (get("target") == "support") && (get("category") == "unread") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Yanıt Bekleyenler
                  <?php
                    $unreadSupports = $db->prepare("SELECT S.id FROM Supports S INNER JOIN SupportCategories SC ON S.categoryID = SC.id INNER JOIN Servers Se ON S.serverID = Se.id INNER JOIN Accounts A ON S.accountID = A.id WHERE S.statusID IN (?, ?)");
                    $unreadSupports->execute(array(1, 3));
                  ?>
                  <?php if ($unreadSupports->rowCount() > 0): ?>
                    <span class="badge badge-warning rounded-pill ml-auto"><?php echo $unreadSupports->rowCount(); ?></span>
                  <?php endif; ?>
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/destek/yanitli" class="nav-link <?php echo ((get("route") == "support") && (get("target") == "support") && (get("category") == "readed") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Yanıtlananlar
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/destek/kapali" class="nav-link <?php echo ((get("route") == "support") && (get("target") == "support") && (get("category") == "closed") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Kapatılanlar
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/destek/kategori" class="nav-link <?php echo ((get("route") == "support") && (get("target") == "category") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Kategoriler
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/destek/kategori/ekle" class="nav-link <?php echo ((get("route") == "support") && (get("target") == "category") && (get("action") == "insert")) ? "active" : null; ?>">
                  Kategori Ekle
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/destek/cevap" class="nav-link <?php echo ((get("route") == "support") && (get("target") == "answer") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Hazır Cevaplar
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/destek/cevap/ekle" class="nav-link <?php echo ((get("route") == "support") && (get("target") == "answer") && (get("action") == "insert")) ? "active" : null; ?>">
                  Hazır Cevap Ekle
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarLeaderboard" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-list"></i> Sıralama
          </a>
          <div class="collapse <?php echo (get("route") == "leaderboards") ? "show" : null; ?>" id="sidebarLeaderboard">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/siralama" class="nav-link <?php echo ((get("route") == "leaderboards") && (get("target") == "leaderboards") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Sıralama Tabloları
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/siralama/ekle" class="nav-link <?php echo ((get("route") == "leaderboards") && (get("target") == "leaderboards") && (get("action") == "insert")) ? "active" : null; ?>">
                  Sıralama Tablosu Ekle
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarPage" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-layout"></i> Sayfa
          </a>
          <div class="collapse <?php echo (get("route") == "page") ? "show" : null; ?>" id="sidebarPage">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/sayfa" class="nav-link <?php echo ((get("route") == "page") && (get("target") == "page") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Sayfalar
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/sayfa/ekle" class="nav-link <?php echo ((get("route") == "page") && (get("target") == "page") && (get("action") == "insert")) ? "active" : null; ?>">
                  Sayfa Ekle
                </a>
              </li>
            </ul>
          </div>
        </li>
		  
		<li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarCustomPage" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-layout"></i> Özel Sayfalar
          </a>
          <div class="collapse <?php echo (get("route") == "custompage") ? "show" : null; ?>" id="sidebarCustomPage">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/ozel-sayfa" class="nav-link <?php echo ((get("route") == "custompage") && (get("target") == "page") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Sayfalar
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/ozel-sayfa/ekle" class="nav-link <?php echo ((get("route") == "custompage") && (get("target") == "page") && (get("action") == "insert")) ? "active" : null; ?>">
                  Sayfa Ekle
                </a>
              </li>
            </ul>
          </div>
        </li>
		  
        <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarBannedAccounts" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-slash"></i> Engel
          </a>
          <div class="collapse <?php echo (get("route") == "banned") ? "show" : null; ?>" id="sidebarBannedAccounts">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/engel" class="nav-link <?php echo ((get("route") == "banned") && (get("target") == "ban") && (!get("category")) && (get("action") == "getAll")) ? "active" : null; ?>">
                  Tümü
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/engel/site" class="nav-link <?php echo ((get("route") == "banned") && (get("target") == "ban") && (get("category") == "site") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Site
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/engel/destek" class="nav-link <?php echo ((get("route") == "banned") && (get("target") == "ban") && (get("category") == "support") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Destek
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/engel/yorum" class="nav-link <?php echo ((get("route") == "banned") && (get("target") == "ban") && (get("category") == "comment") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Yorum
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/engel/ekle" class="nav-link <?php echo ((get("route") == "banned") && (get("target") == "ban") && (get("action") == "insert")) ? "active" : null; ?>">
                  Hesap Engelle
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarDownload" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-download"></i> İndir
          </a>
          <div class="collapse <?php echo (get("route") == "download") ? "show" : null; ?>" id="sidebarDownload">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/indir" class="nav-link <?php echo ((get("route") == "download") && (get("target") == "file") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Dosyalar
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/indir/ekle" class="nav-link <?php echo ((get("route") == "download") && (get("target") == "file") && (get("action") == "insert")) ? "active" : null; ?>">
                  Dosya Ekle
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarBroadcast" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-rss"></i> Duyuru
          </a>
          <div class="collapse <?php echo (get("route") == "broadcast") ? "show" : null; ?>" id="sidebarBroadcast">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/duyuru" class="nav-link <?php echo ((get("route") == "broadcast") && (get("target") == "broadcast") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Duyurular
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/duyuru/ekle" class="nav-link <?php echo ((get("route") == "broadcast") && (get("target") == "broadcast") && (get("action") == "insert")) ? "active" : null; ?>">
                  Duyuru Ekle
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarSlider" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-image"></i> Slider
          </a>
          <div class="collapse <?php echo (get("route") == "slider") ? "show" : null; ?>" id="sidebarSlider">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/slider" class="nav-link <?php echo ((get("route") == "slider") && (get("target") == "slider") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Sliderlar
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/slider/ekle" class="nav-link <?php echo ((get("route") == "slider") && (get("target") == "slider") && (get("action") == "insert")) ? "active" : null; ?>">
                  Slider Ekle
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarPayment" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-dollar-sign"></i> Ödeme
          </a>
          <div class="collapse <?php echo (get("route") == "payment") ? "show" : null; ?>" id="sidebarPayment">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/odeme" class="nav-link <?php echo ((get("route") == "payment") && (get("target") == "payment") && (get("action") == "getAll")) ? "active" : null; ?>">
                  Ödeme Yöntemleri
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/odeme/ekle" class="nav-link <?php echo ((get("route") == "payment") && (get("target") == "payment") && (get("action") == "insert")) ? "active" : null; ?>">
                  Ödeme Yöntemi Ekle
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/odeme/ayarlar" class="nav-link <?php echo ((get("route") == "payment") && (get("target") == "settings")) ? "active" : null; ?>">
                  Ödeme Ayarları
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarTheme" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-layers"></i> Tema
          </a>
          <div class="collapse <?php echo (get("route") == "theme") ? "show" : null; ?>" id="sidebarTheme">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/tema/genel" class="nav-link <?php echo ((get("route") == "theme") && (get("target") == "general") && (get("action") == "update")) ? "active" : null; ?>">
                  Genel
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/tema/header" class="nav-link <?php echo ((get("route") == "theme") && (get("target") == "header") && (get("action") == "update")) ? "active" : null; ?>">
                  Header
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/tema/renk" class="nav-link <?php echo ((get("route") == "theme") && (get("target") == "color") && (get("action") == "update")) ? "active" : null; ?>">
                  Renk
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/tema/css" class="nav-link <?php echo ((get("route") == "theme") && (get("target") == "css") && (get("action") == "update")) ? "active" : null; ?>">
                  CSS
                </a>
              </li>
            </ul>
          </div>
        </li>
		  <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarBan" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
           <i class="fe fe-layers"></i> Server Sistemleri
          </a>
          <div class="collapse <?php echo (get("route") == "ban") ? "show" : null; ?>" id="sidebarBan">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/tema/genel" class="nav-link <?php echo ((get("route") == "ban") && (get("target") == "general") && (get("action") == "update")) ? "active" : null; ?>">
                  Genel
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/tema/header" class="nav-link <?php echo ((get("route") == "ban") && (get("target") == "header") && (get("action") == "update")) ? "active" : null; ?>">
                  Header
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/tema/renk" class="nav-link <?php echo ((get("route") == "ban") && (get("target") == "color") && (get("action") == "update")) ? "active" : null; ?>">
                  Renk
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/tema/css" class="nav-link <?php echo ((get("route") == "ban") && (get("target") == "css") && (get("action") == "update")) ? "active" : null; ?>">
                  CSS
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#sidebarSettings" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="fe fe-settings"></i> Ayarlar
          </a>
          <div class="collapse <?php echo (get("route") == "settings") ? "show" : null; ?>" id="sidebarSettings">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/yonetim-paneli/ayarlar/genel" class="nav-link <?php echo ((get("route") == "settings") && (get("target") == "general") && (get("action") == "update")) ? "active" : null; ?>">
                  Genel Ayarlar
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/ayarlar/sistem" class="nav-link <?php echo ((get("route") == "settings") && (get("target") == "system") && (get("action") == "update")) ? "active" : null; ?>">
                  Sistem Ayarları
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/ayarlar/smtp" class="nav-link <?php echo ((get("route") == "settings") && (get("target") == "smtp") && (get("action") == "update")) ? "active" : null; ?>">
                  SMTP Ayarları
                </a>
              </li>
              <li class="nav-item">
                <a href="/yonetim-paneli/ayarlar/webhooks" class="nav-link <?php echo ((get("route") == "settings") && (get("target") == "webhooks") && (get("action") == "update")) ? "active" : null; ?>">
                  Discord Webhook
                </a>
              </li>
              <!--
              <li class="nav-item">
                <a href="/yonetim-paneli/ayarlar/dil" class="nav-link <?php echo ((get("route") == "settings") && (get("target") == "language") && (get("action") == "update")) ? "active" : null; ?>">
                  Dil Ayarları
                </a>
              </li>
              -->
            </ul>
          </div>
        </li>
          </a>
        </li>
      </ul>
      <?php
        $onlineAccountsHistory = $db->prepare("SELECT OAH.*, A.realname, A.permission FROM OnlineAccountsHistory OAH INNER JOIN Accounts A ON OAH.accountID = A.id WHERE OAH.expiryDate > ?");
        $onlineAccountsHistory->execute(array(date("Y-m-d H:i:s")));
      ?>
      <?php if ($onlineAccountsHistory->rowCount() > 0): ?>
<hr class="my-3">
        <h6 class="navbar-heading text-muted">
          Çevrimiçi Yetkililer
        </h6>
        <ul class="navbar-nav">
          <?php foreach ($onlineAccountsHistory as $readOnlineAccountsHistory): ?>
            <li class="nav-item">
              <a class="d-block nav-link <?php echo ($readOnlineAccountsHistory["realname"] == $readAdmin["realname"]) ? "active" : null; ?>" href="/yonetim-paneli/hesap/goruntule/<?php echo $readOnlineAccountsHistory["accountID"]; ?>" data-toggle="tooltip" data-placement="top" data-original-title="Son Görülme: <?php echo convertTime($readOnlineAccountsHistory["creationDate"]); ?>">
                <div class="row">
                  <div class="col">
                    <?php echo minecraftHead($readSettings["avatarAPI"], $readOnlineAccountsHistory["realname"], 20, "mr-2"); ?>
                    <span>
                      <?php echo $readOnlineAccountsHistory["realname"]; ?>
                      </span>
                    <span>
                      <?php echo verifiedCircle($readOnlineAccountsHistory["permission"]); ?>
                    </span>
                  </div>
                  <div class="col-auto">
                    <span class="text-success">●</span>
                  </div>
                </div>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <!-- Push content down -->
      <div class="mt-auto"></div>
      <!-- Customize -->
    </div> <!-- / .navbar-collapse -->
  </div> <!-- / .container-fluid -->
</nav>
