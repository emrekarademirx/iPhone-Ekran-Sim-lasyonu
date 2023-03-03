<form action="upload.php" method="post" enctype="multipart/form-data">
  Dosya seçin:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Yükle" name="submit">
</form>

<div id="screen-image"></div>

<script>
  // resim yüklendikten sonra ekranda görüntüle
  const image = "<?php echo $target_file; ?>";
  if (image) {
    document.getElementById("screen-image").style.backgroundImage = `url('${image}')`;
  }
</script>
