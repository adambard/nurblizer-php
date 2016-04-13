<?php

function nurble($text)
{
    $nouns = file('nouns.txt', FILE_IGNORE_NEW_LINES);
    $isMatch = (bool) preg_match_all('/\b[a-zA-Z]+\b/', $text, $matches);

    if ($isMatch === true) {
        $words = array_unique(
            array_filter($matches[0], function ($word) use ($nouns) {
                return  in_array($word, $nouns) === false;
            })
        );

        $pattern = sprintf(
            '/(\b)%s(\b)/',
            implode('(\b)|(\b)', $words)
        );
        $replacement = '\1<span class="nurble">nurble</span>\2';
        $text = preg_replace($pattern, $replacement, $text);
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
