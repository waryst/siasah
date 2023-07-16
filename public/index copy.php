<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    dd(PATH());
    // echo "dsfsdf";
//     $file=$_FILES["upload_file"]["tmp_name"];
//     $result=[];

// exec("./LibreOffice-frsh.basic-x86_84.AppImage -env:UserInstallation=file:///tmp/LibreOffice_Conversion_${USER} --headless --convert-to pdf /home/ben/pdfconverter" . $file ."2>&1", $result);
// exec("& C:\Program Files\LibreOffice\program\swriter.exe --headless --convert-to pdf:writer_pdf_Export 'coba.docx' --outdir '/hasil/'" );
exec('soffice  --headless --convert-to pdf :writer_pdf_Export --outdir /hasil/coba.docx');

// $output = exec($command, @@test);
//     $new_file=explode(" ",$result[2]);
//     $new_file=explode("/",$result[3]);
//     $link=$new_file[4];
//     echo "Converted PDF -> <a href='./".$new_file[4]."'>".$new_file[4]."</a>";
//     echo "<br></br>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <form action="#" method="post" enctype="multipart/form-data">
        <button type="submit">coba</button>
    </form>
</body>

</html>
