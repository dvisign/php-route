Vue.component ("login", {
  template: '<section id="ol_before" class="ol">'
              +'<h2>회원로그인</h2>'
              +'<form name="foutlogin" action="<?php echo $outlogin_action_url ?>" onsubmit="return fhead_submit(this);" method="post" autocomplete="off">'
              +'<fieldset>'
                +'<div class="ol_wr">'
                  +'<input type="hidden" name="url" value="<?php echo $outlogin_url ?>">'
                  +'<label for="ol_id" id="ol_idlabel" class="sound_only">회원아이디<strong>필수</strong></label>'
                  +'<input type="text" id="ol_id" name="mb_id" required maxlength="20" placeholder="아이디">'
                  +'<label for="ol_pw" id="ol_pwlabel" class="sound_only">비밀번호<strong>필수</strong></label>'
                  +'<input type="password" name="mb_password" id="ol_pw" required maxlength="20" placeholder="비밀번호" autocomplete="false">'
                  +'<input type="submit" id="ol_submit" value="로그인" class="btn_b02">'
                +'</div>'
                +'<div class="ol_auto_wr">' 
                  +'<div id="ol_auto">'
                    +'<input type="checkbox" name="auto_login" value="1" id="auto_login">'
                    +'<label for="auto_login" id="auto_login_label">자동로그인</label>'
                  +'</div>'
                  +'<div id="ol_svc">'
                    +'<a href="<?php echo G5_BBS_URL ?>/register.php"><b>회원가입</b></a> / <a href="<?php echo G5_BBS_URL ?>/password_lost.php" id="ol_password_lost">정보찾기</a>'
                  +'</div>'
                +'</div>'
              +'</fieldset>'
            +'</form>'
          +'</section>'
});
new Vue({
  el : "#logins"
})