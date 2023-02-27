<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

function pagination_post($count, $total_page = "", $range = 2, $current_page = 1) {

    $showitems = ($range * 2)+1;
    if(empty($count)) $count = 0;
    if(empty($total_page)) $total_page = 1;
    $link_range = $current_page / $showitems;

    echo 'count: ' . $count . "<hr>";
    echo 'total_page: ' . $total_page . "<hr>";
    echo 'current_page: ' . $current_page . "<hr>";
    echo 'showitems: ' . $showitems . "<hr>";

    if( 1 != $total_page ) {
       //echo "<div class=\"pagination\"><span>Page ".$count." of ".$total_page."</span>";
       echo "<nav><ul class=\"pagination d-flex flex-wrap justify-content-center\">";
    }

    if( $current_page > $showitems ) {
        echo "<a href='".get_pagenum_link(1)."'>اولین</a>";
    }

    if(  $current_page > 1 ) {
        // echo "<a href='" . get_pagenum_link($count - 1) . "'>&lsaquo; Previous</a>";
        echo "<li class=\"page-item\">
            <a class=\"page-link d-flex justify-content-center align-content-center align-items-center\" href=\"".get_pagenum_link($current_page - 1)."\" aria-label=\"Previous\">
                <span aria-hidden=\"true\">
                <svg width=\"18\" height=\"18\" viewBox=\"0 0 18 18\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                    <path d=\"M6.375 3.75L11.625 9L6.375 14.25\" stroke=\"#931DB1\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"></path>
                </svg>                    
                </span>
            </a>
        </li>";
    }

    for ( $i = 1; $i <= $total_page; $i++ ) {
        // if ( 1 != $total_page &&( !($i >= $count+$range+1 || $i <= $count-$range-1) || $total_page <= $showitems) ) {
        if ( 1 != $total_page && ($total_page <= $showitems) ) {
            echo ($current_page == $i)
                ? 
                "<li class=\"page-item active\">
                    <a class=\"page-link d-flex justify-content-center align-content-center align-items-center\">".$i."</a>
                </li>"
                :
                "<li class=\"page-item\">
                    <a href='".get_pagenum_link($i)."' class=\"page-link d-flex justify-content-center align-content-center align-items-center\">".$i."</a>
                </li>"
            ;
        } else {
            // if( !($i >= $count+$range+3 || $i <= $count-$range-3) ) {
            //     echo "
            //         <li class=\"page-item\">
            //             <a href='".get_pagenum_link($i)."' class=\"page-link d-flex justify-content-center align-content-center align-items-center\">".$i."</a>
            //         </li>
            //     ";
            // }
        }
    }

    if ( $current_page < $total_page ) {
        //echo "<a href=\"".get_pagenum_link($count + 1)."\">Next &rsaquo;</a>";
        echo "<li class=\"page-item\">
            <a class=\"page-link d-flex justify-content-center align-content-center align-items-center\" href=\"".get_pagenum_link($current_page + 1)."\" aria-label=\"Next\">
                <span aria-hidden=\"true\">
                <svg width=\"18\" height=\"18\" viewBox=\"0 0 18 18\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                    <path d=\"M11.625 14.25L6.375 9L11.625 3.75\" stroke=\"#931DB1\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"></path>
                </svg>
                </span>
            </a>
        </li>";
    }

    if ( $current_page < ($total_page - $showitems) ) {
        echo "<a href='".get_pagenum_link($total_page)."'>آخرین</a>";
    }
    
    if( 1 != $total_page ) {
        echo "</ul></nav>\n";
    }
}


function insertPagination($base_url, $current_page, $total_page, $prev_next = false) {

    $ends_count = 1;  //how many items at the ends (before and after [...])
    $middle_count = 2;  //how many items before and after current page
    $dots = false;

    if( $total_page == 1 ) return;
    ?>
    <ul class="pagination">
        <?php
            if( $prev_next && $current_page && 1 < $current_page ) {  //print previous button?
                ?>
                    <li class="prev">
                        <a href="<?php echo $base_url; ?>/<?php echo $current_page-1; ?>">&laquo; قبل</a>
                    </li>
                <?php
            }
            for( $i = 1; $i <= $total_page; $i++ ) {
                if( $i == $current_page ) {
                    ?>
                        <li class="active">
                            <a><?php echo $i; ?></a>
                        </li>
                    <?php
                    $dots = true;
                } else {
                    if( $i <= $ends_count || ($current_page && $i >= $current_page - $middle_count && $i <= $current_page + $middle_count) || $i > $total_page - $ends_count ) { 
                        ?>
                            <li>
                                <a href="<?php echo $base_url; ?>/<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php
                        $dots = true;
                    } elseif( $dots ) {
                        ?>
                            <li>
                                <a>&hellip;</a>
                            </li>
                        <?php
                        $dots = false;
                    }
                }
            }
            if( $prev_next && $current_page && ($current_page < $total_page || -1 == $total_page) ) { //print next button?
                ?>
                    <li class="next">
                        <a href="<?php echo $base_url; ?>/<?php echo $current_page+1; ?>">بعد &raquo;</a>
                    </li>
                <?php
            }
        ?>
    </ul>
    <?php

}

function insertSearchPagination($base_url, $current_page, $total_page, $prev_next = false) {

    $ends_count = 1;  //how many items at the ends (before and after [...])
    $middle_count = 2;  //how many items before and after current page
    $dots = false;

    if( $total_page == 1 ) return;
    ?>
    <ul class="pagination">
        <?php
            if( $prev_next && $current_page && 1 < $current_page ) {  //print previous button?
                ?>
                    <li class="prev">
                        <a href="<?php echo $base_url; ?>?page=<?php echo $current_page-1; ?>">&laquo; قبل</a>
                    </li>
                <?php
            }
            for( $i = 1; $i <= $total_page; $i++ ) {
                if( $i == $current_page ) {
                    ?>
                        <li class="active">
                            <a><?php echo $i; ?></a>
                        </li>
                    <?php
                    $dots = true;
                } else {
                    if( $i <= $ends_count || ($current_page && $i >= $current_page - $middle_count && $i <= $current_page + $middle_count) || $i > $total_page - $ends_count ) { 
                        ?>
                            <li>
                                <a href="<?php echo $base_url; ?>?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php
                        $dots = true;
                    } elseif( $dots ) {
                        ?>
                            <li>
                                <a>&hellip;</a>
                            </li>
                        <?php
                        $dots = false;
                    }
                }
            }
            if( $prev_next && $current_page && ($current_page < $total_page || -1 == $total_page) ) { //print next button?
                ?>
                    <li class="next">
                        <a href="<?php echo $base_url; ?>?page=<?php echo $current_page+1; ?>">بعد &raquo;</a>
                    </li>
                <?php
            }
        ?>
    </ul>
    <?php

}