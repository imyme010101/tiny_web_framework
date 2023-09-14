<section class="dark:bg-gray-900 p-3">
  <div class="mx-auto w-full px-4">
    <!-- Start coding here -->
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
      <form action="" method="post" id="submitForm" enctype="multipart/form-data">
        <div class="w-full flex flex-col p-3 space-y-2 items-stretch ustify-end flex-shrink-0">
          <div class="flex flex-col pb-5 gap-2">
            <label class="font-semibold text-gray-700 pb-4">
              기본 정보
            </label>

            <div class="flex items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                아이디
              </label>
              <div class="flex-1">
                <input type="text" name="id" value="<?php echo @$data['view']['id']; ?>"
                  class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
              </div>

            </div>
            <div class="flex justify-between gap-2">
              <div class="flex w-1/2 items-center">
                <label class="text-xs m-0 w-36 font-medium text-gray-700">
                  이름
                </label>
                <div class="flex-1">
                  <input type="text" name="name" value="<?php echo @$data['view']['name']; ?>"
                    class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
                </div>
              </div>
              <div class="flex w-1/2 items-center">
                <label class="text-xs m-0 w-36 font-medium text-gray-700">
                  닉네임
                </label>
                <div class="flex-1">
                  <input type="text" name="nick" value="<?php echo @$data['view']['nick']; ?>"
                    class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
                </div>
              </div>
            </div>


            <div class="flex justify-between gap-2">
              <div class="flex w-1/2 items-center">
                <label class="text-xs m-0 w-36 font-medium text-gray-700">
                  이메일
                </label>
                <div class="flex-1">
                  <input type="text" name="email" value="<?php echo @$data['view']['email']; ?>"
                    class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
                </div>
              </div>
              <div class="flex w-1/2 items-center">
                <label class="text-xs m-0 w-36 font-medium text-gray-700">
                  성별
                </label>
                <div class="flex-1">
                  <select name="gender"
                    class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
                    <option value="MALE" <?php echo @$data['view']['gender'] == 'MALE' ? 'selected' : '' ?>>남성</option>
                    <option value="FEMALE" <?php echo @$data['view']['gender'] == 'FEMALE' ? 'selected' : '' ?>>여성</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="flex justify-between gap-2">
              <div class="flex w-1/2 items-center">
                <label class="text-xs m-0 w-36 font-medium text-gray-700">
                  비밀번호
                </label>
                <div class="flex-1">
                  <input type="text" name="password"
                    class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
                </div>
              </div>

              <div class="flex w-1/2 items-center">
                <label class="text-xs m-0 w-36 font-medium text-gray-700">
                  비밀번호 확인
                </label>
                <div class="flex-1">
                  <input type="text" name="password_re"
                    class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
                </div>
              </div>
            </div>


          </div>


          <div class="flex flex-col pb-5 gap-2">
            <label class="font-semibold text-gray-700 pb-4">
              미디어 정보
            </label>
            <div class="flex-1 flex">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
              </label>
              <div class="w-full grid grid-cols-2 gap-2">
                <?php
                $sns = json_decode(@$data['view']['sns']);

                foreach ($data['media'] as $media_key => $media) {
                  if ($media_key == 'receipt')
                    continue;
                  ?>
                  <div class="flex items-center justify-center">
                    <label class="text-xs m-0 w-20 font-medium text-gray-700">
                      <?php echo $media[1]; ?>
                    </label>
                    <div class="flex-1 flex justify-between items-center gap-2">
                      <input type="text" name="sns[<?php echo $media_key; ?>]" value="<?php echo @$sns->{$media_key}; ?>"
                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
                    </div>
                  </div>
                  <?php
                }
                ?>
              </div>
            </div>


          </div>

          <div class="flex flex-col gap-2">
            <label class="font-semibold text-gray-700 pb-4">
              기타 정보
            </label>

            <div class="flex justify-between gap-2">
              <div class="flex w-1/2 items-center">
                <label class="text-xs m-0 w-36 font-medium text-gray-700">
                  전화번호
                </label>
                <div class="flex-1 flex flex-col gap-2">
                  <input type="text" name="phone_number" id="phone_number"
                    value="<?php echo @$data['view']['phone_number'] ?>"
                    class="w-28 text-black placeholder-gray-600 px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
                </div>
              </div>
              <div class="flex w-1/2 items-center">
                <label class="text-xs m-0 w-36 font-medium text-gray-700">
                  마캐팅 동의
                </label>
                <div class="flex-1">
                  <select name="marketing"
                    class="text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
                    <option value="Y" <?php echo @$data['view']['marketing'] == 'Y' ? 'selected' : '' ?>>Y</option>
                    <option value="N" <?php echo @$data['view']['marketing'] == 'N' ? 'selected' : '' ?>>N</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="flex items-center">
              <label class="text-xs m-0 w-36 font-medium text-gray-700">
                주소
              </label>
              <div class="flex-1 flex flex-col gap-2">
                <div class="w-full flex justify-between items-center gap-2">
                  <input placeholder="우편번호" type="text" name="zip_code" id="zip_code"
                    value="<?php echo @$data['view']['zip_code'] ?>"
                    class="w-28 text-black placeholder-gray-600 px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
                  <button type="button" class="bg-black text-white py-2 px-4 rounded-sm"
                    onclick="post_modalHandler(true)">우편번호 검색</button>
                  <input placeholder="기본 주소" type="text" name="address" id="address"
                    value="<?php echo @$data['view']['address'] ?>"
                    class="flex-1 text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
                </div>
                <input placeholder="상세 주소" type="text" name="address_detail"
                  value="<?php echo @$data['view']['address_detail'] ?>"
                  class="flex-1 text-black placeholder-gray-600 w-full px-4 py-2.5 text-base border-transparent rounded-lg bg-gray-200 focus:outline-none">
              </div>
            </div>


          </div>
        </div>
      </form>
    </div>

    <div class="flex gap-2 w-full p-2 justify-end">
      <button type="button" class="bg-black text-white py-2 px-4 rounded-sm submitForm">완료</button>
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
        url: '/member/join',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        type: 'POST',

        success: function (data) {
          if (data.code == 200) {
            alert("정상적으로 처리 되었습니다.");

            location.href = '/admin/member/view?id=' + data.result.id;
          } else {
            alert("Error : " + data.code + " => " + data.message);
          }
        }
      });

    });

    //profile_image 선택 이벤트
    // $("#profile_image").change(function () {
    //   var inputFile = $("input[name='profile_image']");
    //   var files = inputFile[0].files[0];


    //   $.ajax({
    //     url: '/procs/member/profile',
    //     data: formData,
    //     cache: false,
    //     contentType: false,
    //     processData: false,
    //     dataType: "json",
    //     type: 'POST',

    //     success: function (data) {
    //       if (data.code == 200) {
    //         alert("정상적으로 처리 되었습니다.");
    //       } else {
    //         alert(data);
    //       }
    //     }
    //   });
    // })
  });
</script>