<?php

function limitTextChars($content = false, $limit = false, $stripTags = false, $ellipsis = false)
{
  if ($content && $limit) {
    $content  = ($stripTags ? strip_tags($content) : $content);
    $ellipsis = ($ellipsis ? "..." : $ellipsis);
    $content  = mb_strimwidth($content, 0, $limit, $ellipsis);
  }
  return $content;
}
