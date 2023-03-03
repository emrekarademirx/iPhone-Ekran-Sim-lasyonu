<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// resimin gerçek bir resim olup olmadığını kontrol et
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if($check !== false) {
  $uploadOk = 1;
} else {
  echo "Dosya resim değil.";
  $uploadOk = 0;
}

// dosya var mı kontrol et
if (file_exists($target_file)) {
  echo "Üzgünüz, bu dosya adıyla bir dosya zaten mevcut.";
  $uploadOk = 0;
}

// dosya boyutunu kontrol et
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Üzgünüz, dosyanız çok büyük.";
  $uploadOk = 0;
}

// desteklenen formatlar
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Üzgünüz, sadece JPG, JPEG, PNG & GIF dosyaları yüklenebilir.";
  $uploadOk = 0;
}

// eğer her şey yolunda ise dosyayı upload et
if ($uploadOk == 0) {
  echo "Üzgünüz, dosyanız yüklenemedi.";
// eğer her şey yolunda ise dosyayı upload et
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "Dosyanız ". basename( $_FILES["fileToUpload"]["name"]). " adlı dosya başarıyla yüklendi.";
  } else {
    echo "Üzgünüz, dosyanız yüklenirken bir hata oluştu.";
  }
}
?>
