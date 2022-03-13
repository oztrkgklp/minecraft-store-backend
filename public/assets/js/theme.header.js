$(document).ready(function() {
  $("#selectPageTypeList").change(function() {
    var $form = $("#formNestable");
    var $iconpicker = $('[data-toggle="iconpicker"]');
    if ($(this).val() == "custom") {
      $form.find('input[name="pagetype"]').val("custom");
      $form.find('input[name="title"]').val(null);
      $form.find('input[name="icon"]').val(null);
      $form.find('input[name="url"]').val(null);
      $form.find('select[name="tabstatus"]').val(0).trigger("change");
      $iconpicker.iconpicker("setIcon", "fa-500px");
    }
    else if ($(this).val() == "home") {
      $form.find('input[name="pagetype"]').val("home");
      $form.find('input[name="title"]').val("Ana Sayfa");
      $form.find('input[name="icon"]').val("fa fa-home");
      $form.find('input[name="url"]').val("/");
      $form.find('select[name="tabstatus"]').val(0).trigger("change");
      $iconpicker.iconpicker("setIcon", "fa-home");
    }
    else if ($(this).val() == "store") {
      $form.find('input[name="pagetype"]').val("store");
      $form.find('input[name="title"]').val("Mağaza");
      $form.find('input[name="icon"]').val("fa fa-shopping-cart");
      $form.find('input[name="url"]').val("/magaza");
      $form.find('select[name="tabstatus"]').val(0).trigger("change");
      $iconpicker.iconpicker("setIcon", "fa-shopping-cart");
    }
    else if ($(this).val() == "games") {
      $form.find('input[name="pagetype"]').val("games");
      $form.find('input[name="title"]').val("Oyunlar");
      $form.find('input[name="icon"]').val("fa fa-gamepad");
      $form.find('input[name="url"]').val("/oyun");
      $form.find('select[name="tabstatus"]').val(0).trigger("change");
      $iconpicker.iconpicker("setIcon", "fa-gamepad");
    }
    else if ($(this).val() == "lottery") {
      $form.find('input[name="pagetype"]').val("lottery");
      $form.find('input[name="title"]').val("Çarkıfelek");
      $form.find('input[name="icon"]').val("fa fa-pie-chart");
      $form.find('input[name="url"]').val("/carkifelek");
      $form.find('select[name="tabstatus"]').val(0).trigger("change");
      $iconpicker.iconpicker("setIcon", "fa-pie-chart");
    }
    else if ($(this).val() == "credit") {
      $form.find('input[name="pagetype"]').val("credit");
      $form.find('input[name="title"]').val("Kredi");
      $form.find('input[name="icon"]').val("fa fa-try");
      $form.find('input[name="url"]').val("/kredi");
      $form.find('select[name="tabstatus"]').val(0).trigger("change");
      $iconpicker.iconpicker("setIcon", "fa-try");
    }
    else if ($(this).val() == "credit-charge") {
      $form.find('input[name="pagetype"]').val("credit");
      $form.find('input[name="title"]').val("Kredi Yükle");
      $form.find('input[name="icon"]').val("fa fa-try");
      $form.find('input[name="url"]').val("/kredi/yukle");
      $form.find('select[name="tabstatus"]').val(0).trigger("change");
      $iconpicker.iconpicker("setIcon", "fa-try");
    }
    else if ($(this).val() == "credit-send") {
      $form.find('input[name="pagetype"]').val("credit");
      $form.find('input[name="title"]').val("Kredi Gönder");
      $form.find('input[name="icon"]').val("fa fa-try");
      $form.find('input[name="url"]').val("/kredi/gonder");
      $form.find('select[name="tabstatus"]').val(0).trigger("change");
      $iconpicker.iconpicker("setIcon", "fa-try");
    }
    else if ($(this).val() == "leaderboards") {
      $form.find('input[name="pagetype"]').val("leaderboards");
      $form.find('input[name="title"]').val("Sıralama");
      $form.find('input[name="icon"]').val("fa fa-trophy");
      $form.find('input[name="url"]').val("/siralama");
      $form.find('select[name="tabstatus"]').val(0).trigger("change");
      $iconpicker.iconpicker("setIcon", "fa-trophy");
    }
    else if ($(this).val() == "support") {
      $form.find('input[name="pagetype"]').val("support");
      $form.find('input[name="title"]').val("Destek");
      $form.find('input[name="icon"]').val("fa fa-life-ring");
      $form.find('input[name="url"]').val("/destek");
      $form.find('select[name="tabstatus"]').val(0).trigger("change");
      $iconpicker.iconpicker("setIcon", "fa-life-ring");
    }
    else if ($(this).val() == "chest") {
      $form.find('input[name="pagetype"]').val("chest");
      $form.find('input[name="title"]').val("Sandık");
      $form.find('input[name="icon"]').val("fa fa-archive");
      $form.find('input[name="url"]').val("/sandik");
      $form.find('select[name="tabstatus"]').val(0).trigger("change");
      $iconpicker.iconpicker("setIcon", "fa-archive");
    }
    else if ($(this).val() == "download") {
      $form.find('input[name="pagetype"]').val("download");
      $form.find('input[name="title"]').val("İndir");
      $form.find('input[name="icon"]').val("fa fa-download");
      $form.find('input[name="url"]').val("/indir");
      $form.find('select[name="tabstatus"]').val(0).trigger("change");
      $iconpicker.iconpicker("setIcon", "fa-download");
    }
    else {
      $form.find('input[name="pagetype"]').val("custom");
      $form.find('input[name="title"]').val(null);
      $form.find('input[name="icon"]').val(null);
      $form.find('input[name="url"]').val(null);
      $form.find('select[name="tabstatus"]').val(0).trigger("change");
      $iconpicker.iconpicker("setIcon", "fa-500px");
    }
  });
});
