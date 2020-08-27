<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="imagetoolbar" content="no">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">

<title>送付先入力</title>
<meta name="Keywords" content="">
<meta name="description" content="">
<meta name="Priority" value="0">
<link rel="apple-touch-icon-precomposed" href="/apple-touch-icon.png">
<link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" />
<meta property="og:title" content="">
<meta property="og:type" content="website">
<meta property="og:url" content="">
<meta property="og:site_name" content="">
<meta property="og:description" content="">
<meta property="og:image" content="">
<meta name="twitter:card" content="photo">
<meta name="twitter:image" content="">
<!--共通css-->
<link rel="stylesheet" href="../common/css/default.css" media="all">
<link rel="stylesheet" href="../common/css/base_pc.css" media="all">
<link rel="stylesheet" href="../common/css/base_sp.css" media="all">
<!--共通js-->
<script src="../common/js/jquery-1.8.3.min.js"></script>
<script src="../common/js/common.js"></script>
<!--ページ個別css-->
<link rel="stylesheet" href="../common/css/jquery.mCustomScrollbar.css" media="all">
<link rel="stylesheet" href="css/entry_pc.css" media="all">
<link rel="stylesheet" href="css/entry_sp.css" media="all">
<!--ページ個別js-->
<script src="../common/js/jquery.mCustomScrollbar.js"></script>
<script src="js/entry_form.js"></script>
<script src="js/entry_form_input.js"></script>
</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
	<div id="contentsWrap">
		<section id="mv">
			<h1>
				<img src="../common/img/img_mv.png" alt="dummy" class="pc">
				<img src="../common/img/sp/img_mv.png" alt="dummy" class="sp">
			</h1>
		</section>
		<section id="contentsBox" class="form input">
			<div class="inner">
                <form method="post" class="clr" action="/form">
                @csrf
					<h2 class="ttl2">
						送付先入力フォーム
					</h2>
					<p class="lead">当選賞品の送付先をご入力ください。 
						<span class="note">ご入力いただいた情報に誤りがございますと、賞品が届かない場合がございますのでご注意ください。</span>
					</p>
					<div class="formBox">
						<table>
							<tr>
								<th>
									<b>お名前</b>
								</th>
								<td class="error">
									<p>
										<span>姓</span>
										<input type="text" name="name_sei" value="{{ old('name_sei') }}" placeholder="山田" class="size1" maxlength="12">
									</p>
									<p>
										<span>名</span>
										<input type="text" name="name_mei" value="{{ old('name_mei') }}" placeholder="太郎" class="size1" maxlength="12">
									</p>
									<span>
                                    @error('name_sei')<b class="errorTxt">{{ $message }}</b>@enderror
									@error('name_mei')<b class="errorTxt">{{ $message }}</b>@enderror
									</span>
								</td>
							</tr>
							<tr>
								<th>
									<b>フリガナ</b>
								</th>
								<td>
									<p>
										<span>セイ</span>
										<input type="text" name="kana_sei" value="{{ old('kana_sei') }}" placeholder="ヤマダ" class="size1" maxlength="12">
									</p>
									<p>
										<span>メイ</span>
										<input type="text" name="kana_mei" value="{{ old('kana_mei') }}" placeholder="タロウ" class="size1" maxlength="12">
									</p>
									<span>
                                    @error('kana_sei')<b class="errorTxt">{{ $message }}</b>@enderror
									@error('kana_mei')<b class="errorTxt">{{ $message }}</b>@enderror
									</span>
								</td>
							</tr>
							<tr>
								<th>
									<b>住所</b>
								</th>
								<td class="custom">
									<ul>
										<li class="zip">
											<span class="mark">〒</span>
											<input type="text" name="zip1" value="{{ old('zip1') }}" placeholder="123" class="size2" maxlength="3" pattern="\d*" title="半角数字を入力してください">
											<span class="bar">-</span>
											<input type="text" name="zip2" value="{{ old('zip2') }}" placeholder="1234" class="size1" maxlength="4" pattern="\d*" title="半角数字を入力してください">
											<b class="errorTxt"></b>
										</li>
										<li>
											<span>都道府県 old:{{ old('prefecture') }}　　@if( old('prefecure') == '5' ) やまがた　@endif</span>
											<select name="prefecture">
											@foreach ($pref as $k => $v)
												<option value="{{$k}}" @if( old('prefecure') == $k ) selected="selected" @endif>old:{{old('prefecure')}} / {{$v}}</option>
											@endforeach
											</select>
											<b class="errorTxt"></b>
										</li>
										<li>
											<span>市区町村番地</span>
											<input type="text" name="address" value="" placeholder="○○市△△町1-1 " class="size3" maxlength="90">
											<b class="errorTxt"></b>
										</li>
										<li>
											<span>建物名・号室</span>
											<input type="text" name="building" value="" placeholder="□□マンション　101号室" class="size3" maxlength="90">
											<b class="errorTxt"></b>
										</li>
									</ul>
								</td>
							</tr>
							<tr>
								<th>
									<b>メールアドレス</b>
								</th>
								<td class="email">
									<input type="text" name="email" value="" placeholder="test@gpol.co.jp" class="size3">
									<b class="errorTxt"></b>
								</td>
							</tr>
							<tr>
								<th>
									<b>電話番号</b>
								</th>
								<td class="tel">
									<input type="text" name="tel1" value="" placeholder="06" class="size4" maxlength="4" pattern="\d*" title="半角数字を入力してください">
									<span class="bar">-</span>
									<input type="text" name="tel2" value="" placeholder="0000" class="size4" maxlength="4" pattern="\d*" title="半角数字を入力してください">
									<span class="bar">-</span>
									<input type="text" name="tel3" value="" placeholder="0000" class="size4" maxlength="4" pattern="\d*" title="半角数字を入力してください">
									<b class="errorTxt"></b>
								</td>
							</tr>
						</table>
						<div class="formQuestionnaire">
							<h3 class="formQuestionnaireTtl">
								<span>簡単なアンケートへのご協力を
									<br class="sp">お願いします
								</span>
							</h3>
							<dl class="formQuestionnaireBox">
								<dt>
									<b>あなたは、このキャンペーンをどこでお知りになりましたか</b>
								</dt>
								<dd>
									<ul class="formList formList02">
										<li>
											<label>
												<input name="q1" type="radio" value="1">
												<span>店頭装飾を見つけて</span>
											</label>
										</li>
										<li>
											<label>
												<input name="q1" type="radio" value="2">
												<span>商品についている、シールを見て</span>
											</label>
										</li>
										<li>
											<label>
												<input name="q1" type="radio" value="3">
												<span>ホームページで</span>
											</label>
										</li>
										<li>
											<label>
												<input name="q1" type="radio" value="4">
												<span>ブログやSNS、ネットニュースなどの記事で</span>
											</label>
										</li>
										<li>
											<label>
												<input name="q1" type="radio" value="5">
												<span>家族・友人からの紹介</span>
											</label>
										</li>
									</ul>
									<span class="error"></span>
								</dd>
							</dl>
							<dl class="formQuestionnaireBox">
								<dt>
									<b>この商品を購入した理由をお教えください（当てはまるものを全てお選びください）</b>
								</dt>
								<dd>
									<ul class="formList formList02">
										<li>
											<label>
												<input name="q2[1]" type="checkbox" value="1">
												<span>キャンペーン中のマグカップが欲しかったから</span>
											</label>
										</li>
										<li>
											<label>
												<input name="q2[2]" type="checkbox" value="2">
												<span>アーモンドの健康・美容効果に期待して</span>
											</label>
										</li>
										<li>
											<label>
												<input name="q2[3]" type="checkbox" value="3">
												<span>味が好きだから</span>
											</label>
										</li>
										<li>
											<label>
												<input name="q2[4]" type="checkbox" value="4">
												<span>スーパーや街中での試飲会をしていたから</span>
											</label>
										</li>
										<li>
											<label>
												<input name="q2[5]" type="checkbox" value="5">
												<span>特売していたから</span>
											</label>
										</li>
										<li>
											<label>
												<input name="q2[6]" type="checkbox" value="6">
												<span>知人や家族にすすめられたから</span>
											</label>
										</li>
										<li>
											<label>
												<input name="q2[7]" type="checkbox" value="7">
												<span>その他</span>
											</label>
										</li>
									</ul>
									<span class="error"></span>
								</dd>
							</dl>
							<dl class="formQuestionnaireBox">
								<dt>
									<b>ご意見・ご感想がございましたら、ご自由にご記入ください。</b>
								</dt>
								<dd>
									<textarea name="q3" placeholder="ご意見・ご感想がございましたら、400字以内でご記入ください"></textarea>
									<span class="errorTxt"></b>
								</dd>
							</dl>
						</div>
					</div>
					<h3>キャンペーン利用規約
						<br class="sp">および注意事項
					</h3>
					<div class="terms">
						<dl class="scroll">
							<dt>キャンペーンについて</dt>
							<dd>
								<ul class="listDot">
									<li>応募期間：2019年11月1日（金）～2020年1月31日（金）</li>
									<li>賞品は送付先を送信いただいてから、
										<b class="red">2ヶ月以内に順次発送いたします。</b>
									</li>
									<li>パッケージにキャンペーンシールが貼ってある商品がキャンペーン対象商品となります。</li>
									<li>2019年7月1日（月）～9月30日（月）に開催しました
										<b class="red">「アーモンドのある暮らしキャンペーン」のシリアルコードは登録できません</b>のでご注意ください。
										<br>なお、前回お使いのIDとパスワードは引き続きお使いいただけます。
									</li>
									<li>応募期間中であっても、対象商品がなくなり次第、終了とさせていただきます。</li>
									<li>本キャンペーンへのご参加はキャンペーンサイトからのご応募に限ります。</li>
									<li>同一のシリアルコードを使った複数回のポイント登録はできません。</li>
									<li>期間中、何回でもご応募いただけますが、同一賞品の当選権利はお一人様1回のみとさせていただきます。</li>
									<li>
										<b class="red">マイページでの応募のご利用は2020年1月31日(金)23：59まで</b>となります。
									</li>
									<li>
										<b class="red">残ったポイントは2020年1月31日（金）23：59で消滅します</b>ので、お早めにご応募ください。
									</li>
									<li>本キャンペーンへのご参加は、日本在住の方に限らせていただきます。</li>
									<li>賞品の仕様は予告なく変わる可能性がございます。</li>
									<li>ご応募の途中でインターネット接続が途切れてしまった場合に、ご応募が無効となる場合がございます。</li>
									<li>ご応募に関して不正な行為があった場合、当選を取り消させていただく場合がございます。</li>
									<li>2020年3月31日（火）を過ぎても賞品が届かない場合は、キャンペーン事務局(
										<a href="tel:0000000000" class="sp">00-0000-0000</a>
										<span class="tel pc">00-0000-0000</span>)までお問い合わせください。
									</li>
									<li>本キャンペーンの応募にかかるインターネット接続料および通信費は応募者のご負担となります。</li>
									<li>インターネット接続が十分に確保されている状態でご応募ください。</li>
									<li>主催者側は、キャンペーン詳細確認に伴う使用機器・通信における障害、損傷及び応募時の不具合等についての責任は一切負いかねます。</li>
									<li>社員ならびに関係者は本キャンペーンに応募できません。</li>
									<li>キャンペーン終了後でも対象商品が販売されている場合がございますが、ご応募はキャンペーン期間中のみの受付とさせていただきます。</li>
									<li>ご入力いただいた住所が不明、連絡不能などの理由により賞品がお届けできない場合は、当選の権利を無効とさせていただきます。</li>
									<li>賞品の交換、換金、返品等には応じかねますので、予めご了承ください。</li>
									<li>当選の権利はご本人様のもので、第三者に譲渡・換金はできません。</li>
									<li>賞品のお届け先は、日本国内に限らせていただきます。</li>
									<li>シリアルコードはキャンペーン終了まで大切に保管してください。</li>
									<li>抽選に関するお問い合わせはお受けできません。</li>
									<li>配送中の紛失等の事故については、当社では責任を負いかねますので、ご了承ください。</li>
									<li>賞品の配送に関しては宅配業者などを利用させていただきます。</li>
									<li>賞品のお届け日時のご指定はできません。</li>
								</ul>
							</dd>
							<dt>推奨環境</dt>
							<dd>
								<ul class="listDot">
									<li>本キャンペーンサイトの推奨環境は、以下となります。推奨環境以外の端末ではご応募いただけない場合がございます。</li>
								</ul>
								<dl class="tSite">
									<dt>［PC］</dt>
									<dd>Windows：Internet Explorer11、Edge 最新版、Google Chrome 最新版、Mozilla Firefox 最新版</dd>
									<dd>Macintosh：Safari 最新版</dd>
								</dl>
								<dl class="tSite">
									<dt>［スマートフォン・タブレットの場合］</dt>
									<dd>iOS 10.0以上 / Safari 最新版</dd>
									<dd>Android 5.0以上 / Google Chrome 最新版</dd>
								</dl>
							</dd>
							<dt>その他</dt>
							<dd>
								<ul class="listDot">
									<li>個人情報詳細につきましては「
										<a href="#">個人情報保護について</a>」をご参照ください。
									</li>
									<li>ご入力いただいたお客様の個人情報は、住所・氏名・電話番号は賞品発送業務の為、生年月日・性別の項目に関しては商品の購買実態調査の為に利用させていただきます。</li>
									<li>個人情報はお客様の同意なしに、業務委託先以外の第三者に開示・提供することはありません。（法令などにより開示を求められた場合を除く）</li>
								</ul>
							</dd>
						</dl>
					</div>
					<p class="check">
						<label for="checkPolicy">
							<input name="check_policy" id="checkPolicy" type="checkbox" value="1" />
							<span>
								<b>上記規約に同意する</b>
							</span>
						</label>
						<b class="errorTxt"></b>
					</p>
					<p class="btn confirm">
						<button type="submit" disabled>
							<span>確認画面へ</span>
						</button>
					</p>
				</form>
			</div>
			<!-- /.inner -->
		</section>
		<!-- /#contentsBox -->
	</div>
	<!-- /#contents_wrap -->
</body>
</html>