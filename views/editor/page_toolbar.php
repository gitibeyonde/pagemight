<?php

$col2 = '<br/><br/><div class="row"><div class="col-md-6 col-sm-12"><p>col-1</p><br/></div><div class="col-md-6 col-sm-12"><p>col-2</p><br/></div><br/><br/>';
$col3 = '<br/><div class="row"><div class="col-md-4 col-sm-12">col-1<br/></div><div class="col-md-4 col-sm-12">col-2<br/></div><div class="col-md-4 col-sm-12">col-3<br/></div><br/>';
$col4 = '<br/><div class="row"><div class="col-md-3 col-sm-12">col-1<br/></div><div class="col-md-3 col-sm-12">col-2<br/></div><div class="col-md-3 col-sm-12">col-3<br/></div><div class="col-md-3 col-sm-12">col-4<br/></div><br/>';
$col6 = '<br/><div class="row"><div class="col-md-2 col-sm-6">col-1<br/></div><div class="col-md-2 col-sm-6">col-2<br/></div><div class="col-md-2 col-sm-6">col-3<br/></div><div class="col-md-2 col-sm-6">col-4<br/></div><div class="col-md-2 col-sm-6">col-5<br/></div><div class="col-md-2 col-sm-6">col-6<br/></div><br/>';
$col8 = '<br/><div class="row"><div class="col">col-1<br/></div><div class="col">col-2<br/></div><div class="col">col-3<br/></div><div class="col">col-4<br/></div><div class="col">col-5<br/></div><div class="col">col-6<br/></div><div class="col">col-7<br/></div><div class="col">col-8<br/></div><br/>';

?>
<div class="container-fluid no_select">
      <div class="row header-toolbar">
        <div class="col-2">
            <button type="submit" name="submit" value="back" class="btn"
							   onclick="return onClickSubmitButton('<?php echo MAIN_VIEW; ?>');">
            	<span class="material-icons green md-36">arrow_back</span>&nbsp;&nbsp;</button>
        </div>
        <div class="col-4">
            <input type="text" name="page_name" placeholder="page name" size="16" value="<?php echo $page_name; ?>"
            		style="border: 0px;text-decoration: underline;" required>
        </div>
        <div class="col-2">
            <input type="checkbox" name="switchMode" onchange="setDocMode(this.checked);" /> <label for="switchBox">HTML</label>
        </div>
        <div class="col-1">
        </div>
        <div class="col-3">
			<a class="btn btn-sim0" href="/redirect.php?view=editor_view&page_code=<?php echo $page_code; ?>"><b style="color: red;">HTML</b></a>
			<a class="btn btn-sim0" href="/redirect.php?view=editor_css&page_code=<?php echo $page_code; ?>"><b style="color: pink;">CSS</b></a>
			<a class="btn btn-sim0" href="/redirect.php?view=editor_js&page_code=<?php echo $page_code; ?>"><b style="color: pink;">JS</b></a>
        </div>
      </div>

      <div class="row">
		<div class="col-12 toolbar" id="toolBar1">

            <button type="submit" id="save_content" name="submit" value="update" class="btn"
								onclick="return onClickSubmitButton('<?php echo EDITOR_VIEW; ?>');"><span class="material-icons green md-36">save</span></button>

            <button type="submit" name="submit" value="delete"  class="btn"  onclick="return onClickDel('<?php echo MAIN_VIEW; ?>');">
            					<span class="material-icons red md-36">delete</span></button>

			Text:<select
				onchange="formatDoc('formatBlock',this[this.selectedIndex].value);this.selectedIndex=0;">
				<option selected>Format</option>
				<option value="h1">Title 1 &lt;h1&gt;</option>
				<option value="h2">Title 2 &lt;h2&gt;</option>
				<option value="h3">Title 3 &lt;h3&gt;</option>
				<option value="h4">Title 4 &lt;h4&gt;</option>
				<option value="h5">Title 5 &lt;h5&gt;</option>
				<option value="h6">Title 6 &lt;h6&gt;</option>
				<option value="h7">Title 7 &lt;h7&gt;</option>
				<option value="p">Para &lt;p&gt;</option>
				<option value="pre">Pre &lt;pre&gt;</option>
			</select>



			Foreground:<input type="color" class="form-control-color" value="#000000" title="Choose text color"
						onchange="formatDoc('forecolor',this.value);this.value='#000000';">
		    Background:<input type="color" class="form-control-color" value="#ffffff" title="Choose text color"
						onchange="formatDoc('backcolor',this.value);this.value='#ffffff';">

            Insert:<select
                    onchange="formatDoc('insertHtml',this[this.selectedIndex].value + '\n');this.selectedIndex=0;">
                    <option class="heading" selected>Row</option>
                     <option value='<?php echo $col2; ?>'>2 Col</option>
                     <option value='<?php echo $col3; ?>'>3 Col</option>
                     <option value='<?php echo $col4; ?>'>4 Col</option>
                     <option value='<?php echo $col6; ?>'>6 Col</option>
                     <option value='<?php echo $col8; ?>'>8 Col</option>
              </select>
		</div>
     </div>


     <div class="row">

		<div class="col-12 toolbar" id="toolBar2">
			<img class="intLink" title="Clean"
				onclick="if(validateMode()&&confirm('Are you sure?')){oDoc.innerHTML=sDefTxt};"
				src="data:image/gif;base64,R0lGODlhFgAWAIQbAD04KTRLYzFRjlldZl9vj1dusY14WYODhpWIbbSVFY6O7IOXw5qbms+wUbCztca0ccS4kdDQjdTLtMrL1O3YitHa7OPcsd/f4PfvrvDv8Pv5xv///////////////////yH5BAEKAB8ALAAAAAAWABYAAAV84CeOZGmeaKqubMteyzK547QoBcFWTm/jgsHq4rhMLoxFIehQQSAWR+Z4IAyaJ0kEgtFoLIzLwRE4oCQWrxoTOTAIhMCZ0tVgMBQKZHAYyFEWEV14eQ8IflhnEHmFDQkAiSkQCI2PDC4QBg+OAJc0ewadNCOgo6anqKkoIQA7" />
				<img class="intLink" title="Undo" onclick="formatDoc('undo');"
				src="data:image/gif;base64,R0lGODlhFgAWAOMKADljwliE33mOrpGjuYKl8aezxqPD+7/I19DV3NHa7P///////////////////////yH5BAEKAA8ALAAAAAAWABYAAARR8MlJq7046807TkaYeJJBnES4EeUJvIGapWYAC0CsocQ7SDlWJkAkCA6ToMYWIARGQF3mRQVIEjkkSVLIbSfEwhdRIH4fh/DZMICe3/C4nBQBADs=" />
			<img class="intLink" title="Redo" onclick="formatDoc('redo');"
				src="data:image/gif;base64,R0lGODlhFgAWAMIHAB1ChDljwl9vj1iE34Kl8aPD+7/I1////yH5BAEKAAcALAAAAAAWABYAAANKeLrc/jDKSesyphi7SiEgsVXZEATDICqBVJjpqWZt9NaEDNbQK1wCQsxlYnxMAImhyDoFAElJasRRvAZVRqqQXUy7Cgx4TC6bswkAOw==" />
			<img class="intLink" title="Remove formatting"
				onclick="formatDoc('removeFormat')"
				src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAABGdBTUEAALGPC/xhBQAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAAOxAAADsQBlSsOGwAAAAd0SU1FB9oECQMCKPI8CIIAAAAIdEVYdENvbW1lbnQA9syWvwAAAuhJREFUOMtjYBgFxAB501ZWBvVaL2nHnlmk6mXCJbF69zU+Hz/9fB5O1lx+bg45qhl8/fYr5it3XrP/YWTUvvvk3VeqGXz70TvbJy8+Wv39+2/Hz19/mGwjZzuTYjALuoBv9jImaXHeyD3H7kU8fPj2ICML8z92dlbtMzdeiG3fco7J08foH1kurkm3E9iw54YvKwuTuom+LPt/BgbWf3//sf37/1/c02cCG1lB8f//f95DZx74MTMzshhoSm6szrQ/a6Ir/Z2RkfEjBxuLYFpDiDi6Af///2ckaHBp7+7wmavP5n76+P2ClrLIYl8H9W36auJCbCxM4szMTJac7Kza////R3H1w2cfWAgafPbqs5g7D95++/P1B4+ECK8tAwMDw/1H7159+/7r7ZcvPz4fOHbzEwMDwx8GBgaGnNatfHZx8zqrJ+4VJBh5CQEGOySEua/v3n7hXmqI8WUGBgYGL3vVG7fuPK3i5GD9/fja7ZsMDAzMG/Ze52mZeSj4yu1XEq/ff7W5dvfVAS1lsXc4Db7z8C3r8p7Qjf///2dnZGxlqJuyr3rPqQd/Hhyu7oSpYWScylDQsd3kzvnH738wMDzj5GBN1VIWW4c3KDon7VOvm7S3paB9u5qsU5/x5KUnlY+eexQbkLNsErK61+++VnAJcfkyMTIwffj0QwZbJDKjcETs1Y8evyd48toz8y/ffzv//vPP4veffxpX77z6l5JewHPu8MqTDAwMDLzyrjb/mZm0JcT5Lj+89+Ybm6zz95oMh7s4XbygN3Sluq4Mj5K8iKMgP4f0////fv77//8nLy+7MCcXmyYDAwODS9jM9tcvPypd35pne3ljdjvj26+H2dhYpuENikgfvQeXNmSl3tqepxXsqhXPyc666s+fv1fMdKR3TK72zpix8nTc7bdfhfkEeVbC9KhbK/9iYWHiErbu6MWbY/7//8/4//9/pgOnH6jGVazvFDRtq2VgiBIZrUTIBgCk+ivHvuEKwAAAAABJRU5ErkJggg==">
			<img class="intLink" title="Bold" onclick="formatDoc('bold');"
				src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAInhI+pa+H9mJy0LhdgtrxzDG5WGFVk6aXqyk6Y9kXvKKNuLbb6zgMFADs=" />
			<img class="intLink" title="Italic" onclick="formatDoc('italic');"
				src="data:image/gif;base64,R0lGODlhFgAWAKEDAAAAAF9vj5WIbf///yH5BAEAAAMALAAAAAAWABYAAAIjnI+py+0Po5x0gXvruEKHrF2BB1YiCWgbMFIYpsbyTNd2UwAAOw==" />
			<img class="intLink" title="Underline"
				onclick="formatDoc('underline');"
				src="data:image/gif;base64,R0lGODlhFgAWAKECAAAAAF9vj////////yH5BAEAAAIALAAAAAAWABYAAAIrlI+py+0Po5zUgAsEzvEeL4Ea15EiJJ5PSqJmuwKBEKgxVuXWtun+DwxCCgA7" />
			<img class="intLink" title="Left align"
				onclick="formatDoc('justifyleft');"
				src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAIghI+py+0Po5y02ouz3jL4D4JMGELkGYxo+qzl4nKyXAAAOw==" />
			<img class="intLink" title="Center align"
				onclick="formatDoc('justifycenter');"
				src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAIfhI+py+0Po5y02ouz3jL4D4JOGI7kaZ5Bqn4sycVbAQA7" />
			<img class="intLink" title="Right align"
				onclick="formatDoc('justifyright');"
				src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAIghI+py+0Po5y02ouz3jL4D4JQGDLkGYxouqzl43JyVgAAOw==" />
			<img class="intLink" title="Numbered list"
				onclick="formatDoc('insertorderedlist');"
				src="data:image/gif;base64,R0lGODlhFgAWAMIGAAAAADljwliE35GjuaezxtHa7P///////yH5BAEAAAcALAAAAAAWABYAAAM2eLrc/jDKSespwjoRFvggCBUBoTFBeq6QIAysQnRHaEOzyaZ07Lu9lUBnC0UGQU1K52s6n5oEADs=" />
			<img class="intLink" title="Dotted list"
				onclick="formatDoc('insertunorderedlist');"
				src="data:image/gif;base64,R0lGODlhFgAWAMIGAAAAAB1ChF9vj1iE33mOrqezxv///////yH5BAEAAAcALAAAAAAWABYAAAMyeLrc/jDKSesppNhGRlBAKIZRERBbqm6YtnbfMY7lud64UwiuKnigGQliQuWOyKQykgAAOw==" />
			<img class="intLink" title="Quote"
				onclick="formatDoc('formatblock','blockquote');"
				src="data:image/gif;base64,R0lGODlhFgAWAIQXAC1NqjFRjkBgmT9nqUJnsk9xrFJ7u2R9qmKBt1iGzHmOrm6Sz4OXw3Odz4Cl2ZSnw6KxyqO306K63bG70bTB0rDI3bvI4P///////////////////////////////////yH5BAEKAB8ALAAAAAAWABYAAAVP4CeOZGmeaKqubEs2CekkErvEI1zZuOgYFlakECEZFi0GgTGKEBATFmJAVXweVOoKEQgABB9IQDCmrLpjETrQQlhHjINrTq/b7/i8fp8PAQA7" />
			<img class="intLink" title="Delete indentation"
				onclick="formatDoc('outdent');"
				src="data:image/gif;base64,R0lGODlhFgAWAMIHAAAAADljwliE35GjuaezxtDV3NHa7P///yH5BAEAAAcALAAAAAAWABYAAAM2eLrc/jDKCQG9F2i7u8agQgyK1z2EIBil+TWqEMxhMczsYVJ3e4ahk+sFnAgtxSQDqWw6n5cEADs=" />
			<img class="intLink" title="Add indentation"
				onclick="formatDoc('indent');"
				src="data:image/gif;base64,R0lGODlhFgAWAOMIAAAAADljwl9vj1iE35GjuaezxtDV3NHa7P///////////////////////////////yH5BAEAAAgALAAAAAAWABYAAAQ7EMlJq704650B/x8gemMpgugwHJNZXodKsO5oqUOgo5KhBwWESyMQsCRDHu9VOyk5TM9zSpFSr9gsJwIAOw==" />

            <img class="intLink" title="Hyperlink"
                onclick="var sLnk=prompt('Write the URL here or set blank to remove hyperlink ','http:\/\/'); formatDoc('createlink',sLnk); "
                src="data:image/gif;base64,R0lGODlhFgAWAOMKAB1ChDRLY19vj3mOrpGjuaezxrCztb/I19Ha7Pv8/f///////////////////////yH5BAEKAA8ALAAAAAAWABYAAARY8MlJq7046827/2BYIQVhHg9pEgVGIklyDEUBy/RlE4FQF4dCj2AQXAiJQDCWQCAEBwIioEMQBgSAFhDAGghGi9XgHAhMNoSZgJkJei33UESv2+/4vD4TAQA7" />
            <img class="intLink" title="Cut" onclick="formatDoc('cut');"
                src="data:image/gif;base64,R0lGODlhFgAWAIQSAB1ChBFNsRJTySJYwjljwkxwl19vj1dusYODhl6MnHmOrpqbmpGjuaezxrCztcDCxL/I18rL1P///////////////////////////////////////////////////////yH5BAEAAB8ALAAAAAAWABYAAAVu4CeOZGmeaKqubDs6TNnEbGNApNG0kbGMi5trwcA9GArXh+FAfBAw5UexUDAQESkRsfhJPwaH4YsEGAAJGisRGAQY7UCC9ZAXBB+74LGCRxIEHwAHdWooDgGJcwpxDisQBQRjIgkDCVlfmZqbmiEAOw==" />
            <img class="intLink" title="Copy" onclick="formatDoc('copy');"
                src="data:image/gif;base64,R0lGODlhFgAWAIQcAB1ChBFNsTRLYyJYwjljwl9vj1iE31iGzF6MnHWX9HOdz5GjuYCl2YKl8ZOt4qezxqK63aK/9KPD+7DI3b/I17LM/MrL1MLY9NHa7OPs++bx/Pv8/f///////////////yH5BAEAAB8ALAAAAAAWABYAAAWG4CeOZGmeaKqubOum1SQ/kPVOW749BeVSus2CgrCxHptLBbOQxCSNCCaF1GUqwQbBd0JGJAyGJJiobE+LnCaDcXAaEoxhQACgNw0FQx9kP+wmaRgYFBQNeAoGihCAJQsCkJAKOhgXEw8BLQYciooHf5o7EA+kC40qBKkAAAGrpy+wsbKzIiEAOw==" />
            <img class="intLink" title="Paste" onclick="formatDoc('paste');"
                src="data:image/gif;base64,R0lGODlhFgAWAIQUAD04KTRLY2tXQF9vj414WZWIbXmOrpqbmpGjudClFaezxsa0cb/I1+3YitHa7PrkIPHvbuPs+/fvrvv8/f///////////////////////////////////////////////yH5BAEAAB8ALAAAAAAWABYAAAWN4CeOZGmeaKqubGsusPvBSyFJjVDs6nJLB0khR4AkBCmfsCGBQAoCwjF5gwquVykSFbwZE+AwIBV0GhFog2EwIDchjwRiQo9E2Fx4XD5R+B0DDAEnBXBhBhN2DgwDAQFjJYVhCQYRfgoIDGiQJAWTCQMRiwwMfgicnVcAAAMOaK+bLAOrtLUyt7i5uiUhADs=" />

            <img class="intLink" title="Print" onclick="printDoc();"
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAABGdBTUEAALGPC/xhBQAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9oEBxcZFmGboiwAAAAIdEVYdENvbW1lbnQA9syWvwAAAuFJREFUOMvtlUtsjFEUx//n3nn0YdpBh1abRpt4LFqtqkc3jRKkNEIsiIRIBBEhJJpKlIVo4m1RRMKKjQiRMJRUqUdKPT71qpIpiRKPaqdF55tv5vvusZjQTjOlseUkd3Xu/3dPzusC/22wtu2wRn+jG5So/OCDh8ycMJDflehMlkJkVK7KUYN+ufzA/RttH76zaVocDptRxzQtNi3mRWuPc+6cKtlXZ/sddP2uu9uXlmYXZ6Qm8v4Tz8lhF1H+zDQXt7S8oLMXtbF4e8QaFHjj3kbP2MzkktHpiTjp9VH6iHiA+whtAsX5brpwueMGdONdf/2A4M7ukDs1JW662+XkqTkeUoqjKtOjm2h53YFL15pSJ04Zc94wdtibr26fXlC2mzRvBccEbz2kiRFD414tKMlEZbVGT33+qCoHgha81SWYsew0r1uzfNylmtpx80pngQQ91LwVk2JGvGnfvZG6YcYRAT16GFtW5kKKfo1EQLtfh5Q2etT0BIWF+aitq4fDbk+ImYo1OxvGF03waFJQvBCkvDffRyEtxQiFFYgAZTHS0zwAGD7fG5TNnYNTp8/FzvGwJOfmgG7GOx0SAKKgQgDMgKBI0NJGMEImpGDk5+WACEwEd0ywblhGUZ4Hw5OdUekRBLT7DTgdEgxACsIznx8zpmWh7k4rkpJcuHDxCul6MDsmmBXDlWCH2+XozSgBnzsNCEE4euYV4pwCpsWYPW0UHDYBKSWu1NYjENDReqtKjwn2+zvtTc1vMSTB/mvev/WEYSlASsLimcOhOBJxw+N3aP/SjefNL5GePZmpu4kG7OPr1+tOfPyUu3BecWYKcwQcDFmwFKAUo90fhKDInBCAmvqnyMgqUEagQwCoHBDc1rjv9pIlD8IbVkz6qYViIBQGTJPx4k0XpIgEZoRN1Da0cij4VfR0ta3WvBXH/rjdCufv6R2zPgPH/e4pxSBCpeatqPrjNiso203/5s/zA171Mv8+w1LOAAAAAElFTkSuQmCC">


        </div>

     </div>
 </div>