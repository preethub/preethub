<?php
/**
 * Create pagination markup
 *
 * @param $baseUrl string
 * @param $totalResults int
 * @param $resultsPerPage int
 * @param $currentPage int
 * @param $queryStringArray array
 */
function pagination($baseUrl, $totalResults, $resultsPerPage, $currentPage, $queryStringArray=[]) {
    //total pages to show
    $totalPages = ceil($totalResults/$resultsPerPage);
    
    //if only one page then no point in showing a single paginated link
    if($totalPages <=1 )
    return '';
 
    //build the query string if provided
    $queryString = '';
  /* if($queryStringArray)
    $queryString = '&'.http_build_query($queryStringArray);
    */
    //show not more than 3 paginated links on right and left side
    $rightLinks = $currentPage+3;
    $previousLinks = $currentPage-3;
    ob_start();
    
    ?>
    <ul class="pagination">
        <?php
        //if page number 1 is not shown then show the "First page" link
        if($previousLinks>1) {
            ?>
            <li>
                <a href="<?php echo $baseUrl.'?page=1'.$queryString; ?>" aria-label="First">
                    <span aria-hidden="true">&laquo;&laquo;</span>
                </a>
            </li>
            <?php
        }
    
        //disable previous button when first page
        if($currentPage == 1) {
            ?>            
            <?php 
        }
        
        //if current page > 1 only then show previous page
        if($currentPage > 1) {
            ?>
            <li><a href="<?php echo $baseUrl.'/page/'.($currentPage-1).$queryString; ?>">Previous</a></li>
            <?php 
        }
        
        //Create left-hand side links
        for($i = $previousLinks; $i <= $currentPage; $i++){
            if($i>0) {
                if($i==$currentPage) { ?>
                    <li class="current"><a href=""><?php echo $i; ?></a></li>
                <?php }
                else { ?>
                    <li>
                        <a href="<?php echo $baseUrl.'/page/'.$i.$queryString; ?>"><?php echo $i; ?></a>
                    </li>
                <?php }    
            }            
        }
        
        //middle pages
        if(false)
        for($i=1; $i<=$totalPages; $i++) {
            if($i==$currentPage) { ?>
                <li class="active"><a href=""><?php echo $i; ?></a></li>
            <?php }
            else { ?>
                <li>
                    <a href="<?php echo $baseUrl.'/page/'.$i.$queryString; ?>"><?php echo $i; ?></a>
                </li>
        <?php }
        }
        
        //right side links
        for($i = $currentPage+1; $i < $rightLinks ; $i++){
            if($i<=$totalPages){
                if($i==$currentPage) { ?>
                    <li class="active"><a href=""><?php echo $i; ?></a></li>
                <?php }
                else { ?>
                    <li>
                        <a href="<?php echo $baseUrl.'/page/'.$i.$queryString; ?>"><?php echo $i; ?></a>
                    </li>
                    <?php
                }
            }
        }
        
        //if current page is not last page then only show next page link
        if($currentPage != $totalPages) { ?>
             <li><a href="<?php echo $baseUrl.'/page/'.($currentPage+1).$queryString; ?>">Next</a></li>
        <?php 
        }
        
        //if current page is last page then show next page link disabled
        if($currentPage == $totalPages) {         
        }
        
        if($rightLinks<$totalPages) {
            ?>
            <li><a href="<?php echo $baseUrl.'/page/'.$totalPages.$queryString; ?>">&raquo;&raquo;</a></li>
            <?php
        }
    ?>
    </ul>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
