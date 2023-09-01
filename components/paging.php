<div class="w-full flex items-center justify-center py-4">
  <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->

  <div class="w-full flex items-center justify-between">

    
      <?php
      $pg_html = "";
      
      if (strpos($paging_url, 'page=') === false) {
        $paging_url = 'page=0' . ($paging_url ? '&' : '') . $paging_url;
      }

      $paging_url = $paging_base_url . '?' . $paging_url;

      $pg_html .= '<div class="flex">';
      //if ($cur_page > 1) {
      if ($total_page > 0) {
        $this_url = preg_replace('/(page=)([^&]+)/', '${1}1', $paging_url);
        $pg_html .= "
          <button class='flex items-center pt-3 text-gray-600 hover:text-point1 cursor-pointer'>
            <p class='text-sm ml-3 font-medium leading-none'>처음</p>
          </button>    
        " . PHP_EOL;
      }
      
      $start_page = (((int) (($page - 1) / $paging_limit)) * $paging_limit) + 1;
      $end_page = $start_page + $paging_limit - 1;

      if ($end_page >= $total_page) {
        $end_page = $total_page;
      }

      if ($start_page > 1) {
        $this_url = preg_replace('/(page=)([^&]+)/', '${1}' . ($page - 1), $paging_url);
        $pg_html .= "
          <button class='flex items-center pt-3 text-gray-600 hover:text-point1 cursor-pointer'>
            <p class='text-sm ml-3 font-medium leading-none'>이전</p>
          </button>    
        " . PHP_EOL;
      }
      $pg_html .= '</div>' . PHP_EOL;

      $pg_html .= '<div class="flex">';

      if ($total_page > 0) {
        for ($k = $start_page; $k <= $end_page; $k++) {
          $page_url = preg_replace('/(page=)([^&]+)/', '${1}' . $k, $paging_url);

          if ($page != $k)
            $pg_html .= "
              <p
              class='text-sm font-medium leading-none cursor-pointer text-gray-600 hover:text-point1 border-t border-transparent hover:border-point1 pt-3 mr-4 px-2'>
              {$k}</p>
            " . PHP_EOL;
          else
            $pg_html .= "
              <p
              class='text-sm font-black leading-none cursor-pointer text-point1 border-t border-point1 pt-3 mr-4 px-2'>
              {$k}</p>
            " . PHP_EOL;
        }
      }
      $pg_html .= '</div>';

      $pg_html .= '<div class="flex">';
      if ($total_page > $end_page) {
        $this_url = preg_replace('/(page=)([^&]+)/', '${1}' . ($page + 1), $paging_url);
        $pg_html .= "
          <button class='flex items-center pt-3 text-gray-600 hover:text-point1 cursor-pointer'>
            <p class='text-sm font-medium leading-none mr-3'>다음</p>
          </button>    
        " . PHP_EOL;
      }

      //if ($cur_page < $total_page) {
      if ($total_page > 0) {
        $this_url = preg_replace('/(page=)([^&]+)/', '${1}' . $total_page, $paging_url);
        $pg_html .= "
          <button class='flex items-center pt-3 text-gray-600 hover:text-point1 cursor-pointer'>
            <p class='text-sm font-medium leading-none mr-3'>마지막</p>
          </button>    
        " . PHP_EOL;
      }
      $pg_html .= '</div>' . PHP_EOL;

      echo $pg_html;
      ?>

  </div>
</div>

<script>
  $(document).ready(function () {
    $(".pg_page").click(function () {
      location.href = $(this).attr("href");
    });
  });

</script>