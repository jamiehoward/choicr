 <?php if (isset($_GET['tagteam'])) { 
 var_dump($choice1_pic);
 }
 ?>
 
 <h2 class="title"><?=$category_name?></h2>
      <div class="games clearfix">
        <h2><?=$decision_title?></h2>
        <p><?=$description?><?php if(isset($readmore)) {?>... <a href="#" class="readmore">Read more</a><?php }?></p>
        <div class="more"><p><?=$description?></p></div>
		<?php if (isset($already_voted)) { //Don't allow the user to vote ?>
		<ul class="list1 clearfix">
			<li class="css3"> 
				<?php 
				$filepath = base_url('img/post') . '/' . $choice1_pic;
				if ($choice1_pic !== '0' && is_200($filepath)) { ?>
					<a href=""><img src="<?=base_url()?>img/post/<?=$choice1_pic?>" alt="<?=$choice1_title?>" class="css3" /></a>
				<?php } else { ?>
					<a href=""><img src="<?=base_url()?>img/default_large.png" alt="<?=$choice1_title?>" class="css3" /></a>
				<?php } ?>
				<a href="" class="button1 <?php if ($already_voted == 0) { echo "active"; } ?> css3"><span><?=$choice1_title?></span></a>
			</li>
			<li class="css3">
				<?php if ($choice2_pic !== '0') { ?>
					<a href=""><img src="<?=base_url()?>img/post/<?=$choice2_pic?>" alt="<?=$choice2_title?>" class="css3" /></a>
				<?php } else { ?>
					<a href=""><img src="<?=base_url()?>img/default_large.png" alt="<?=$choice2_title?>" class="css3" /></a>
				<?php } ?>
				<a href="" class="button1 <?php if ($already_voted == 1) { echo "active"; } ?> css3"><span><?=$choice2_title?></span></a>
			</li>
        </ul>
		<?php } else { ?>
        <ul class="list1 clearfix">
			<li class="css3"> 
				<?php if ($choice1_pic === '0') { ?>
					<a href="<?=base_url()?>index.php/vote/submit_vote/<?=$post?>/0/<?=$this->session->userdata('userID')?>"><img src="<?=base_url()?>img/default_large.png" alt="<?=$choice1_title?>" class="css3" /></a>	
				<?php } else { ?>
					<a href="<?=base_url()?>index.php/vote/submit_vote/<?=$post?>/0/<?=$this->session->userdata('userID')?>"><img src="<?=base_url()?>img/post/<?=$choice1_pic?>" alt="<?=$choice1_title?>" class="css3" /></a>
				<?php } ?>
				
				<a href="<?=base_url()?>index.php/vote/submit_vote/<?=$post?>/0/<?=$this->session->userdata('userID')?>" class="button1 css3"><span><?=$choice1_title?></span></a>
			</li>
			<li class="css3">
				<?php if ($choice2_pic === '0') { ?>
					<a href="<?=base_url()?>index.php/vote/submit_vote/<?=$post?>/1/<?=$this->session->userdata('userID')?>"><img src="<?=base_url()?>img/default_large.png" alt="<?=$choice1_title?>" class="css3" /></a>
				<?php } else { ?>
					<a href="<?=base_url()?>index.php/vote/submit_vote/<?=$post?>/1/<?=$this->session->userdata('userID')?>"><img src="<?=base_url()?>img/post/<?=$choice2_pic?>" alt="<?=$choice2_title?>" class="css3" /></a>
				<?php } ?>
				<a href="<?=base_url()?>index.php/vote/submit_vote/<?=$post?>/1/<?=$this->session->userdata('userID')?>" class="button1 css3"><span><?=$choice2_title?></span></a>
			</li>
        </ul>
		<?php }?>
      </div>
      <div class="comments clearfix">
        <?php $formName = 'comment/new_comment/' . $post;
		echo form_open($formName); ?>
          <h3>Please vote to leave a comment...</h3>
		  <?php if (isset($loggedIn)) {?>
          <div class="comment-form css3">
            <textarea title="textarea" class="textarea css3"  name="comment_text" rows="1" cols="1">&nbsp;</textarea>
            <div class="action clearfix"> 
				
				<span><span class="checkbox">
				<input title="checkbox" type="checkbox" value="" class="checkbox" />
				</span> Facebook</span> <span><span class="checkbox">
				<input title="checkbox" type="checkbox" value="" class="checkbox" />
				</span> Twitter</span>
              <input type="submit" value="" class="submit" />
            </div>
          </div>
		  <?php }?>
          <ul>
			<!-- Comment -->
			<?php 
			//Get list of comments
			$CommentSQL = "SELECT * FROM `Comments` WHERE `dbIDGroup` = '$comment_group' AND `dbIDCnt` = '$post' AND `dbCommReply` IS NULL ORDER BY `dbAddDate` DESC";
			$CommentResults = $this->db->query($CommentSQL);
			$total_comments = $CommentResults->num_rows();
			foreach ($CommentResults->result() as $comment)
			{
				if (!empty($comment->dbCommTxt) && strlen($comment->dbCommTxt) > 2) {
				$CommentAuthorSQL = "SELECT `dbUsrCnt`, `dbUsrName`, `dbUsrPic` FROM `Users` WHERE `dbUsrCnt` IN (SELECT `dbUsrCnt` FROM `Comments` WHERE `dbCommCnt` = " . $comment->dbCommCnt . ");";
				$CommentAuthorResults = $this->db->query($CommentAuthorSQL);
				foreach ($CommentAuthorResults->result() as $comment_author) { }
				if (isset($comment_author)) {
			?>
			<?php 
			if ($comment_author->dbUsrPic) {
				$filepath = base_url() . '/img/profile/' . $comment_author->dbUsrPic;
				if (is_200($filepath)) {
					$backgroundImage = $comment_author->dbUsrPic;
				} else {
					$backgroundImage = 'default.jpg';
				}
			} else {
				$backgroundImage = 'default.jpg';
			} ?>
            <li class="clearfix"> <span class="avatar css3" style="background-image:url('/img/profile/<?php echo $backgroundImage;?>'); background-size:50px 49px; background-repeat:no-repeat;">&nbsp;</span>
              <div class="entry">
                <h3>
					<a href="<?=base_url()?>index.php/profile/view/<?=$comment_author->dbUsrCnt?>/<?=$this->config->item('default_profile_view')?>"><?=$comment_author->dbUsrName?></a><span></span> <?php /* if (isset($loggedIn)) {?><a href="#" class="reply">reply</a><?php } */?>
				</h3>
                <p><?=$comment->dbCommTxt?></p>
              </div>
			  <!-- Comment replies -->
				  
				  <?php //Get list of comments
			$ReplySQL = "SELECT * FROM `Comments` WHERE `dbIDGroup` = '$comment_group' AND `dbIDCnt` = '$post' AND `dbCommReply` = " . $comment->dbCommCnt . " ORDER BY `dbAddDate` DESC;";
			$ReplyResults = $this->db->query($ReplySQL);
			if ($ReplyResults->num_rows() > 0)
			{ ?>
				<ul>
				<?php foreach($ReplyResults->result() as $reply)
				{
				$ReplyAuthorSQL = "SELECT `dbUsrCnt`, `dbUsrName` FROM `Users` WHERE `dbUsrCnt` IN (SELECT `dbUsrCnt` FROM `Comments` WHERE `dbCommCnt` = " . $reply->dbCommCnt . ");";
				$ReplyAuthorResults = $this->db->query($ReplyAuthorSQL);
				foreach ($ReplyAuthorResults->result() as $reply_author) { }?>
					<li class="clearfix"> 
						<img src="<?=base_url()?>images/avatar1.gif" alt="avatar" class="css3" />
						<div class="entry">
						<h3>
							<a href="#"><?=$reply_author->dbUsrName?></a>
						</h3>
						<p><?=$reply->dbCommTxt?></p>
						</div>
					</li>
				<?php } ?>
				</ul>
            </li>
			<?php } ?>
            <ul>
            </ul>
			<?php  } } }?>
          </ul>
        </form>
        <a href="#" class="button2 css3">Load more...</a> </div>