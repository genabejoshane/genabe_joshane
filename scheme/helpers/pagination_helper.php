<?php
function paginate($total, $perPage, $currentPage, $baseUrl) {
    $totalPages = ceil($total / $perPage);
    $html = '<nav class="pagination">';
    for ($i = 1; $i <= $totalPages; $i++) {
        $active = $i == $currentPage ? 'active' : '';
        $html .= "<a class='$active' href='{$baseUrl}{$i}'>$i</a> ";
    }
    $html .= '</nav>';
    return $html;
}
