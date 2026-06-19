<?php

$blacklist = [];

if (file_exists("black_list.json")) {
    $blacklist = json_decode(file_get_contents("black_list.json"), true) ?: [];
}

$folders = [];

foreach (scandir(__DIR__) as $item) {

    if ($item === "." || $item === "..") continue;
    if (!is_dir(__DIR__ . "/" . $item)) continue;
    if (in_array($item, $blacklist)) continue;

    $folders[] = $item;
}

?>
<!DOCTYPE html>
<html dir="rtl">
<head>
<meta charset="UTF-8">
<title>جستجوی پوشه‌ها</title>
<style>
body{
    font-family:tahoma;
    max-width:800px;
    margin:auto;
    padding:20px;
}
input{
    width:100%;
    padding:12px;
    font-size:16px;
    box-sizing:border-box;
}
a{
    display:block;
    padding:10px;
    margin:5px 0;
    text-decoration:none;
    border:1px solid #ddd;
    border-radius:8px;
    color:#000;
}
a:hover{
    background:#f5f5f5;
}
</style>
</head>
<body>

<h2>📁 فایل‌ها</h2>

<input type="text" id="search" placeholder="جستجو...">

<div id="folders">

<?php
foreach($folders as $folder){
    echo '<a href="'.htmlspecialchars($folder).'/">📁 '.htmlspecialchars($folder).'</a>';
}
?>

</div>

<script>
const search = document.getElementById("search");

search.addEventListener("input", () => {
    const q = search.value.toLowerCase();

    document.querySelectorAll("#folders a").forEach(el => {
        el.style.display =
            el.textContent.toLowerCase().includes(q)
            ? "block"
            : "none";
    });
});
</script>

</body>
</html>
