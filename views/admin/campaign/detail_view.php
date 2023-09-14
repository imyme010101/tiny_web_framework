<section class="dark:bg-gray-900 p-3">
  <div class="mx-auto w-full px-4">
    <!-- Start coding here -->
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
      <div class="w-full flex flex-col p-3 space-y-2 items-stretch ustify-end flex-shrink-0">
        <div class="flex flex-col pb-5 gap-2">
          <label class="font-semibold text-gray-700 pb-4">
            기본 정보
          </label>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              제목
            </label>
            <div class="flex-1">
              <input name="title" value="<?php echo $data['view']['title']; ?>" disabled
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
            </div>
          </div>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              한줄 소개
            </label>
            <div class="flex-1">
              <input name="memo" value="<?php echo $data['view']['memo']; ?>" disabled
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
            </div>
          </div>

          <div class="flex justify-between gap-2">
            <div class="flex w-1/2 items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                리뷰어 선정수
              </label>
              <div class="flex-1">
                <input type="number" name="stock" disabled
                  value="<?php echo $data['view']['stock'] ? $data['view']['stock'] : 0; ?>"
                  class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
              </div>
            </div>

            <div class="flex w-1/2 items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                미디어
              </label>
              <div class="flex-1">
                <ul class="flex items-center justify-start gap-2">
                  <?php
                  foreach ($data['media'] as $media_key => $media_val) {
                    ?>
                    <li class="text-xs">

                      <input class="sr-only peer" type="radio" value="<?php echo $media_key; ?>" name="media"
                        id="media_<?php echo $media_key; ?>" disabled <?php echo $media_key == $data['view']['media'] ? 'checked' : ''; ?>>
                      <label
                        class="flex justify-center items-center rounded-sm px-6 py-2 m-0 cursor-pointer peer border border-gray-200 peer-checked:ring-point1 peer-checked:ring-2 peer-checked:border-transparent"
                        for="media_<?php echo $media_key; ?>">
                        <?php echo $media_val[1]; ?>
                      </label>

                    </li>
                    <?php
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              카테고리
            </label>
            <div class="flex-1 flex justify-between gap-2">
              <select id="category_lv1" name="parent_category_idx" disabled
                class="w-1/2 text-black placeholder-gray-600 px-4 py-2.5 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                <option>카테고리 선택 하세요.</option>
                <?php
                foreach ($data['category_lv1'] as $cate_key => $cate_val) {
                  ?>
                  <option value="<?php echo $cate_key; ?>" <?php echo $cate_key == @$data['category_depth'][0] ? 'selected' : ''; ?>>
                    <?php echo $cate_val; ?>
                  </option>
                  <?php
                }
                ?>
              </select>

              <select id="category_lv2" name="category_idx" disabled
                class="w-1/2 text-black placeholder-gray-600 px-4 py-2.5 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                <option>소카테고리 선택 하세요.</option>
                <?php
                foreach ($data['category_lv2'][$data['category_depth'][0]] as $cate2_key => $cate2_val) {
                  ?>
                  <option value="<?php echo $cate2_key; ?>" <?php echo $cate2_key == @$data['category_depth'][1] ? 'selected' : ''; ?>>
                    <?php echo $cate2_val; ?>
                  </option>
                  <?php
                }
                ?>
              </select>
            </div>
          </div>

        </div>

        <div class="flex items-center">
          <div class="w-1/2 flex justify-between items-center gap-2">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              노출
            </label>
            <div class="flex-1 flex justify-between gap-2">
              <input class="sr-only peer" type="checkbox" value="Y" name="md" id="md" <?php echo @$data['view']['md'] == 'Y' ? 'checked' : ''; ?>> <label
                class="flex justify-center items-center rounded-sm px-6 py-2 m-0 cursor-pointer peer border border-gray-200 peer-checked:ring-point1 peer-checked:ring-2 peer-checked:border-transparent"
                for="md">
                MD 추천
              </label>
            </div>
          </div>

          <div class="w-1/2 flex justify-between items-center gap-2">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              지역
            </label>
            <div class="flex-1 flex justify-between gap-2">
              <select name="area" disabled
                class="w-1/2 text-black placeholder-gray-600 px-4 py-2.5 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                <option>카테고리 선택 하세요.</option>
                <?php
                foreach ($data['area'] as $area_key => $area_val) {
                  ?>
                  <option value="<?php echo $area_val; ?>" <?php echo $area_val == @$data['view']['area'] ? 'selected' : ''; ?>>
                    <?php echo $area_val; ?>
                  </option>
                  <?php
                }
                ?>
              </select>
            </div>
          </div>

        </div>

        <div class="flex flex-col pb-5 gap-2">
          <label class="font-semibold text-gray-700 pb-4">
            기간 정보
          </label>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              캠페인 신청기간
            </label>
            <div class="flex-1 flex justify-between items-center gap-2">
              <input type="date" placeholder="시작일" name="start_date" id="start_date" disabled
                value="<?php echo date('Y-m-d', strtotime($data['view']['start_date'])); ?>"
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
              <span>-</span>
              <input type="date" placeholder="끝일" name="end_date" id="end_date" disabled
                value="<?php echo date('Y-m-d', strtotime($data['view']['end_date'])); ?>"
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">

            </div>
          </div>

          <div class="flex justify-between gap-2">
            <div class="w-1/2 flex items-center justify-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                리뷰어 선정기간
              </label>
              <div class="flex-1">
                <input type="date" placeholder="" name="pick_date" id="pick_date" disabled
                  value="<?php echo date('Y-m-d', strtotime($data['view']['pick_date'])); ?>"
                  class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
              </div>
            </div>

            <div class="w-1/2 flex items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                콘텐츠 등록기간
              </label>
              <div class="flex-1 flex justify-between gap-2">
                <input type="date" placeholder="" name="write_start_date" id="write_start_date" disabled
                  value="<?php echo date('Y-m-d', strtotime($data['view']['write_start_date'])); ?>"
                  class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                <span>-</span>
                <input type="date" placeholder="" name="write_end_date" id="write_end_date" disabled
                  value="<?php echo date('Y-m-d', strtotime($data['view']['write_end_date'])); ?>"
                  class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
              </div>
            </div>
          </div>

        </div>

        <div class="flex flex-col pb-5 gap-2">
          <label class="font-semibold text-gray-700 pb-4">
            상세 정보
          </label>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              상세 페이지
            </label>
            <div class="flex justify-between items-center gap-2">
              <label class="text-xs">PC</label>
              <a href="<?php echo $data['view']['main_img']; ?>" target="_blank"><img
                  src="<?php echo $data['view']['main_img']; ?>" class="w-20 h-20 border border-gray-200" alt=""></a>
              <label class="text-xs">M</label>
              <a href="<?php echo $data['view']['m_main_img']; ?>" target="_blank"><img
                  src="<?php echo $data['view']['m_main_img']; ?>" class="w-20 h-20 border border-gray-200" alt=""></a>
            </div>
          </div>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              썸네일
            </label>
            <div class="flex justify-between items-center gap-2">
              <label class="text-xs">PC</label>
              <a href="<?php echo $data['view']['thumb_img']; ?>" target="_blank"><img
                  src="<?php echo $data['view']['thumb_img']; ?>" class="w-20 h-20 border border-gray-200" alt=""></a>
              <label class="text-xs">M</label>
              <a href="<?php echo $data['view']['m_thumb_img']; ?>" target="_blank"><img
                  src="<?php echo $data['view']['m_thumb_img']; ?>" class="w-20 h-20 border border-gray-200" alt=""></a>
            </div>
          </div>
        </div>


        <div class="flex flex-col pb-5 gap-2">
          <label class="font-semibold text-gray-700 pb-4">
            콘텐츠 정보
          </label>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              제공 내역
            </label>
            <div class="flex-1 flex justify-between items-center gap-2">
              <textarea name="detail_contents" id="detail_contents" disabled
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"><?php echo $data['view']['detail_contents']; ?></textarea>
            </div>
          </div>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              주소
            </label>
            <div class="flex-1 flex flex-col gap-2">
              <div class="w-full flex justify-between items-center gap-2">
                <input placeholder="우편번호" name="zip_code" id="zip_code" disabled
                  value="<?php echo $data['view']['zip_code']; ?>"
                  class="w-28 text-black placeholder-gray-600 px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                <input placeholder="기본 주소" name="address" id="address" value="<?php echo $data['view']['address']; ?>"
                  class="flex-1 text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
              </div>
              <input placeholder="상세 주소" name="address_detail" id="address_detail" disabled
                value="<?php echo $data['view']['address_detail']; ?>"
                class="flex-1 text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
            </div>
          </div>
          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              방문 및 예약 안내
            </label>
            <div class="flex-1 flex justify-between items-center gap-2">
              <textarea name="info" id="info" disabled
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"><?php echo $data['view']['info']; ?></textarea>
            </div>
          </div>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              캠페인 미션
            </label>
            <div class="flex-1 flex justify-between items-center gap-2">
              <textarea name="mission" id="mission" disabled
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"><?php echo $data['view']['mission']; ?></textarea>
            </div>
          </div>

          <div class="flex flex-col gap-2">
            <div class="flex items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                제목 키워드
              </label>
              <div class="flex-1 flex justify-between items-center gap-2">
                <input type="text" placeholder="키워드 , 으로 구분 하여 어러게 입력" name="title_tags" id="title_tags" disabled
                  value="<?php echo @$data['view']['title_tags'] ?>"
                  class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
              </div>
            </div>

            <div class="flex items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                본문 키워드
              </label>
              <div class="flex-1 flex justify-between items-center gap-2">
                <input type="text" placeholder="키워드 , 으로 구분 하여 어러게 입력" name="contents_tags" id="contents_tags" disabled
                  value="<?php echo @$data['view']['contents_tags'] ?>"
                  class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
              </div>
            </div>
          </div>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              가이드 라인
            </label>
            <div class="flex-1 flex justify-between items-center gap-2">
              <textarea name="guide" id="guide" disabled
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"><?php echo $data['view']['guide']; ?></textarea>
            </div>
          </div>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              주의사항
            </label>
            <div class="flex-1 flex justify-between items-center gap-2">
              <textarea name="caution" id="caution" disabled
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"><?php echo $data['view']['caution']; ?></textarea>
            </div>
          </div>
        </div>
      </div>

      <div class="flex gap-2 w-full p-2 justify-center">
        <button type="button" onclick="location.href = '/admin/campaign/write?idx=<?php echo $data['view']['idx']; ?>';"
          class="bg-black text-white py-2 px-4 rounded-sm">수정가기</button>
        <button type="button" onClick="location.history.back();"
          class="bg-white border border-black text-black py-2 px-4 rounded-sm">뒤로가기</button>
      </div>
    </div>
  </div>
</section>

<?php
echo $data['address_html'];
?>

<script type="text/javascript">
  $(document).ready(function () {
    const category_lv2_obj = <?php echo json_encode($data['category_lv2']) ?>;

    $('#category_lv1').change(function () {
      var category_lv1 = $(this).val();

      $('#category_lv2').empty();
      $('#category_lv2').append('<option>소카테고리 선택 하세요.</option>');

      for (var i = 0; i < category_lv2_obj[category_lv1].length; i++) {
        $('#category_lv2').append('<option value="' + category_lv2_obj[category_lv1][i]['idx'] + '">' + category_lv2_obj[category_lv1][i]['name'] + '</option>');
      }
    });

    $(".submitForm").click(function () {
      var form = $('#submitForm')[0];
      var formData = new FormData(form);
      $.ajax({
        url: '/campaign/write',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        type: 'POST',

        success: function (data) {
          if (data.code == 200) {
            alert(data.message);

            location.href = '/admin/cp/view?idx=' + data.result.idx;
          } else {
            alert("Error : " + data.code + " => " + data.message);
          }
        }
      })
    })
  });
</script>