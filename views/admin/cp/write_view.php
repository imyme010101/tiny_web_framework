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
              캠페인 제목
            </label>
            <div class="flex-1">
              <input placeholder=""
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
            </div>
          </div>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              캠페인 소개
            </label>
            <div class="flex-1">
              <input placeholder=""
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
            </div>
          </div>

          <div class="flex justify-between gap-2">
            <div class="flex w-1/2 items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                리뷰어 선정수
              </label>
              <div class="flex-1">
                <input placeholder=""
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

                      <input class="sr-only peer" type="radio" value="yes" name="media"
                        id="media_<?php echo $media_key; ?>">
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
              <select id="category_lv1"
                class="w-1/2 text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                <option>대카테고리 선택 하세요.</option>
                <?php
                foreach ($data['category_lv1'] as $category) {
                  ?>
                  <option value="<?php echo $category['idx']; ?>">
                    <?php echo $category['name']; ?>
                  </option>
                  <?php
                }
                ?>
              </select>
              <select id="category_lv2"
                class="w-1/2 text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                <option>소카테고리 선택 하세요.</option>
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
              <input type="date" placeholder="시작일"
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
              <span>-</span>
              <input type="date" placeholder="끝일"
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">

            </div>
          </div>

          <div class="flex justify-between gap-2">
            <div class="w-1/2 flex items-center justify-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                리뷰어 선정기간
              </label>
              <div class="flex-1">
                <input type="date" placeholder=""
                  class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
              </div>
            </div>

            <div class="w-1/2 flex items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                콘텐츠 등록기간
              </label>
              <div class="flex-1">
                <input type="date" placeholder=""
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
            <div class="flex-1 flex justify-between items-center gap-2">
              <input type="file" placeholder="시작일"
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
            </div>
          </div>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              썸네일
            </label>
            <div class="flex-1 flex justify-between items-center gap-2">
              <input type="file" placeholder="시작일"
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
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
              <textarea
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></textarea>
            </div>
          </div>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              주소
            </label>
            <div class="flex-1 flex flex-col gap-2">
              <div class="w-full flex justify-between items-center gap-2">
                <input 
                  placeholder="우편번호"
                  class="w-28 text-black placeholder-gray-600 px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"
                >
                <button type="button" class="bg-black text-white py-2 px-4 rounded-sm">우편번호 검색</button>
                <input placeholder="기본 주소"
                  class="flex-1 text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
              </div>
              <input placeholder="상세 주소"
                class="flex-1 text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
            </div>
          </div>
          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              방문 및 예약 안내
            </label>
            <div class="flex-1 flex justify-between items-center gap-2">
              <textarea
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></textarea>
            </div>
          </div>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              캠페인 미션
            </label>
            <div class="flex-1 flex justify-between items-center gap-2">
              <textarea
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></textarea>
            </div>
          </div>

          <div class="flex flex-col gap-2">
            <div class="flex items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                제목 키워드
              </label>
              <div class="flex-1 flex justify-between items-center gap-2">
                <input type="text" placeholder="키워드 , 으로 구분 하여 어러게 입력"
                  class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
              </div>
            </div>

            <div class="flex items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                본문 키워드
              </label>
              <div class="flex-1 flex justify-between items-center gap-2">
                <input type="text" placeholder="키워드 , 으로 구분 하여 어러게 입력"
                  class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
              </div>
            </div>
          </div>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              가이드 라인
            </label>
            <div class="flex-1 flex justify-between items-center gap-2">
              <textarea
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></textarea>
            </div>
          </div>

          <div class="flex items-center">
            <label class="text-xs m-0 w-36 font-medium text-gray-700">
              주의사항
            </label>
            <div class="flex-1 flex justify-between items-center gap-2">
              <textarea
                class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></textarea>
            </div>
          </div>
        </div>
      </div>

      <div class="flex gap-2 w-full p-2 justify-center">
        <button type="button" class="bg-black text-white py-2 px-4 rounded-sm">완료</button>
      </div>
    </div>
  </div>
</section>

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
    })
  });
</script>