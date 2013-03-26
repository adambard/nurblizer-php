<?php

function nurble($text){
    $nouns = file("nouns.txt", FILE_IGNORE_NEW_LINES);
    $text = strtoupper($text);
    $words = preg_split(
        '/\w/',
        preg_replace('/[^a-z ]/', '', strtolower($text)));

    foreach($words as $word){
        if(!in_array($word, $nouns)){
            $pattern = '/(\b)' . $word . '(\b)/i';
            $replacement = '\1<span class="nurble">nurble</span>\2';
            $text = preg_replace($pattern, $replacement, $text);
        }
    }

    return str_replace("\n", '<br>', $text);
}

include '_header.php'; ?>

<h1>Your Nurbled Text</h1>
<div><?php echo nurble($_POST['text']); ?></div>
<p>
    <a href="/">&lt;&lt; Back</a>
</p>

<?php include '_footer.php';
