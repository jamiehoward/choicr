      <div class="create-profile">
        <h2>Create</h2>
        <p>Create a decision! A few examples are <em>'Where should I go on my date?'</em>,<br />
          <em>'Which tie should I wear to the interview?'</em>, or <em>'Which song <br />
          should my band open up with at our next show?'</em>.The possibilities are<br /> endless!</p>
        <form action="#" method="post">
          <ul>
            <li><span class="textbox">
              <input type="text" onfocus="if(this.value=='Decision Title') this.value='';" onblur="if(this.value=='') this.value='Decision Title';" value="Decision Title" />
              </span></li>
            <li><span class="textarea">
              <textarea rows="1" cols="1" onfocus="if(this.value=='Decision Summary/Story') this.value='';" onblur="if(this.value=='') this.value='Decision Summary/Story';" >Decision Summary/Story</textarea>
              </span></li>
            <li><span class="textbox">
              <input type="text" onfocus="if(this.value=='Choice #1') this.value='';" onblur="if(this.value=='') this.value='Choice #1';" value="Choice #1" />
              </span></li>
            <li><span class="textbox">
              <input type="text" onfocus="if(this.value=='Choice #2') this.value='';" onblur="if(this.value=='') this.value='Choice #2';" value="Choice #2" />
              </span></li>
           
            <li>
              <select class="selectbox" name="">
				<?php $catSQL = "SELECT dbCatName FROM `Categories` ORDER BY dbCatName;";
                $catResult = $this->db->query($catSQL);
                foreach ($catResult->result() as $category) { ?>
                <option>
                <a href="#"><img src="<?=base_url()?>images/categories/<?=$category->dbCatName?>_icon.png" alt="category" /> 
				<?=$category->dbCatName?></a>
                </option>
                <?php } ?>
              </select>
            </li>
            <li><span class="textbox">
   				<p><input type="text" onfocus="if(this.value=='Expiration date') this.value='';" onblur="if(this.value=='') this.value='Expiration date';" value="Expiration date" id="datepicker"></p>
                </span>
            </li>
            <li><span class="textbox">
   				<p><input type="text" onfocus="if(this.value=='Time to expire') this.value='';" onblur="if(this.value=='') this.value='Time to expire';" value="Time to expire" id="timepicker"></p>
                </span>
            </li>
             <li class="submit">
              <input type="submit" class="submit-btn" value="" />
              <a href="#" class="prev-btn"></a> <?php /* <span class="checkbox">
              <input type="checkbox" />
              </span>I agree to the terms.*/?> </li> 
          </ul>
        </form>
      </div>