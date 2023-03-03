<html>
  <head>
    <title>iPhone Ekran Simülasyonu</title>
    <style>
      .iphone-screen {
        width: 500px;
        height: 800px;
        border: 1px solid black;
        position: relative;
      }
      .screen-image {
        position: absolute;
        top: 50px;
        left: 50px;
        right: 50px;
        bottom: 150px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
      }
      .controls {
        position: absolute;
        bottom: 50px;
        left: 50px;
        right: 50px;
        height: 50px;
        display: flex;
        justify-content: space-between;
      }
      .control-item {
        width: 33%;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <div class="iphone-screen">
      <div class="screen-image" id="screen-image">
        <!-- Ekran resmi buraya gelecek -->
      </div>
      <div class="controls">
        <div class="control-item">
          <button onclick="document.getElementById('screen-image').style.backgroundImage = 'url(clock.png)';">Saat</button>
        </div>
        <div class="control-item">
          <button onclick="document.getElementById('screen-image').style.backgroundImage = 'url(calendar.png)';">Tarih</button>
        </div>
        <div class="control-item">
          <button onclick="document.getElementById('screen-image').style.backgroundImage = 'url(operator.png)';">Operatör</button>
        </div>
      </div>
    </div>
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" value="Resmi Yükle" name="submit">
    </form>
  </body>
</html>

<?php
if(isset($_POST["submit"])) {
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  // resimin gerçek bir resim olup olmadığını kontrol et
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "Dosya resim - " . $check["mime"] . ".";
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
      ?>
      <script>
        document.getElementById("screen-image").style.backgroundImage = "url('<?php echo $target_file; ?>')";
      </script>
      <?php
    } else {
      echo "Üzgünüz, dosyanız yüklenirken bir hata oluştu.";
    }
  }
}
