<?php

$blacklist = [];

if (file_exists("black_list.json")) {
    $blacklist = json_decode(file_get_contents("black_list.json"), true);

    if (!is_array($blacklist)) {
        $blacklist = [];
    }
}

$folders = [];

foreach (scandir(__DIR__) as $item) {
    if ($item === "." || $item === "..") continue;
    if (!is_dir(__DIR__ . "/" . $item)) continue;
    if (in_array($item, $blacklist)) continue;

    $folders[] = $item;
}

sort($folders, SORT_NATURAL | SORT_FLAG_CASE);
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
    background: linear-gradient(135deg,#667eea,#764ba2);
    min-height:100vh;
}
input{
    width:100%;
    padding:12px;
    font-size:16px;
    box-sizing:border-box;
}
a{
    transition:.2s;
}

a:hover{
    transform:translateY(-2px);
}
.har{
    color: #1f2937;
    text-shadow: 20px 10px 8px rgba(0, 0, 0, 0.67);

}
.ser{
    background: rgba(255, 255, 255, 0.35);
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
    border: 4px solid rgba(255, 255, 255, 0.72);
    border-radius: 16px;
    
}
</style>
</head>
<body>

<h2 class="har">📁 فایل‌ها</h2>

<input class="ser" type="text" id="search" placeholder="جستجو...">

<div id="folders">

<?php

foreach($folders as $folder){
    echo '<a class="ser" href="'.htmlspecialchars($folder).'/">📁 '.htmlspecialchars($folder).'</a>';
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

