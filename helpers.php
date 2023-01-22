<?php

function getStatusBadgeColor(string $status): string
{
    if ($status === "in progress") {
        return 'bg-dark';
    } else if ($status === "completed") {
        return "bg-success";
    }

    return 'bg-primary';
}

function preparePaginatedUrl($page)
{
    $url = parse_url($_SERVER['REQUEST_URI']);
    $q = [];
    if (isset($url['query'])) {
        parse_str($url['query'], $q);
    }
    $q['page'] = $page;
    $newUrl = $url['path'] . '?' . http_build_query($q);
    return $newUrl;
}

function createPaginationHtml($rowCount, $perPage, $currentPage)
{
    $perPageHtml = '';
    if ($rowCount) {
        $perPageHtml .= "<nav><ul class='pagination justify-content-end'>";
        $perPageHtml .= "<li class='page-item " . ($currentPage == 1 ? 'disabled' : '') . " '><a class='page-link' href='" . preparePaginatedUrl($currentPage - 1) . "' tabindex='-1' aria-disabled='true'>Previous</a></li>";

        $pageCount = ceil($rowCount / $perPage);

        if ($pageCount > 1) {
            for ($i = 1; $i <= $pageCount; $i++) {
                $perPageHtml .= "<li class='page-item " . ($i == $currentPage ? 'active' : '') . " '><a class='page-link' href='" . preparePaginatedUrl($i) . "'>{$i}</a></li>";
            }
        }

        $perPageHtml .= "<li class='page-item " . ($pageCount == $currentPage ? 'disabled' : '') . "'><a class='page-link' href='" . preparePaginatedUrl($currentPage + 1) . "'>Next</a></li>";

        $perPageHtml .= " </ul></nav>";

        return $perPageHtml;
    }
}
