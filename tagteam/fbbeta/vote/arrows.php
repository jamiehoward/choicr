<?php
	$ref = $_REQUEST['ref'];
	$place = $_REQUEST['place'];
		if ($place == NULL) { $place = 0; }
	$PrevArrow = 1;
	$NextArrow = 1;
	$NextPlace = $place + 1;
	$PrevPlace = $place - 1;
	if ($_REQUEST['arcat'] != NULL)
		{
		$CatSQL = " AND dbCatCnt = " . $_REQUEST['arcat'];
		$ArrowCat = $_REQUEST['arcat'];
		}
	else
		{
		$CatSQL = "";
		}
	if ($ref == "blenderrecent" || $ref == "browserecent")
		{
		$NextArrowSQL = "SELECT dbPostCnt FROM Posts WHERE dbExpDate > NOW()" . $CatSQL ." ORDER BY dbAddDate DESC LIMIT " . $NextPlace . ", 1";
		$PrevArrowSQL = "SELECT dbPostCnt FROM Posts WHERE dbExpDate > NOW()" . $CatSQL ." ORDER BY dbAddDate DESC LIMIT " . $PrevPlace . ", 1";
		}
	elseif ($ref == "blendercomments" || $ref == "browsecomments")
		{
		$NextArrowSQL = "SELECT dbPostCnt FROM Posts p LEFT OUTER JOIN 
					(SELECT c.dbIDCnt, c.dbIDGroup, COUNT(*) AS comment_count 
					FROM Comments c WHERE c.dbIDGroup = 1 GROUP BY c.dbIDCnt ) agg
					ON p.dbPostCnt = agg.dbIDCnt 
					WHERE p.dbExpDate > Now()" . $CatSQL ."
					ORDER BY agg.comment_count DESC LIMIT " . $NextPlace . ", 1";
		$PrevArrowSQL = "SELECT dbPostCnt FROM Posts p LEFT OUTER JOIN 
					(SELECT c.dbIDCnt, c.dbIDGroup, COUNT(*) AS comment_count 
					FROM Comments c WHERE c.dbIDGroup = 1 GROUP BY c.dbIDCnt ) agg
					ON p.dbPostCnt = agg.dbIDCnt 
					WHERE p.dbExpDate > Now()" . $CatSQL ."
					ORDER BY agg.comment_count DESC LIMIT " . $PrevPlace . ", 1";
		}
	elseif ($ref == "blenderexpiring" || $ref == "browseexpiring")
		{
		$NextArrowSQL = "SELECT * FROM Posts LEFT JOIN Users ON Posts.dbUsrCnt = Users.dbUsrCnt WHERE Posts.dbExpDate > NOW()" . $CatSQL ." ORDER BY Posts.dbExpDate ASC LIMIT " . $NextPlace . ", 1";
		$PrevArrowSQL = "SELECT * FROM Posts LEFT JOIN Users ON Posts.dbUsrCnt = Users.dbUsrCnt WHERE Posts.dbExpDate > NOW()" . $CatSQL ." ORDER BY Posts.dbExpDate ASC LIMIT " . $PrevPlace . ", 1";
		}
	elseif ($ref == "blendervotes" || $ref == "browsevotes")
		{
		$NextArrowSQL = "SELECT p.*, COUNT(v.dbPostCnt) AS numvotes 
					FROM Posts AS p 
					LEFT JOIN
					Votes AS v
					ON p.dbPostCnt= v.dbPostCnt
					INNER JOIN
						(
						SELECT
						p2.dbPostCnt AS dbPostCnt, COUNT(v2.dbPostCnt) AS numvotes
						FROM Posts AS p2
						LEFT JOIN
						Votes AS v2
						ON p2.dbPostCnt=v2.dbPostCnt
						GROUP BY p2.dbPostCnt
						) AS x
					ON
					x.dbPostCnt=p.dbPostCnt
					WHERE p.dbExpDate > Now()" . $CatSQL ."
					GROUP BY p.dbPostCnt
					ORDER BY x.numvotes DESC LIMIT " . $NextPlace . ", 1";
		$PrevArrowSQL = "SELECT p.*, COUNT(v.dbPostCnt) AS numvotes 
					FROM Posts AS p 
					LEFT JOIN
					Votes AS v
					ON p.dbPostCnt= v.dbPostCnt
					INNER JOIN
						(
						SELECT
						p2.dbPostCnt AS dbPostCnt, COUNT(v2.dbPostCnt) AS numvotes
						FROM Posts AS p2
						LEFT JOIN
						Votes AS v2
						ON p2.dbPostCnt=v2.dbPostCnt
						GROUP BY p2.dbPostCnt
						) AS x
					ON
					x.dbPostCnt=p.dbPostCnt
					WHERE p.dbExpDate > Now()" . $CatSQL ."
					GROUP BY p.dbPostCnt
					ORDER BY x.numvotes DESC LIMIT " . $PrevPlace . ", 1";
		}


		$NextArrowResult = mysql_query($NextArrowSQL,$dbconnect);
		$NextArrowCount = mysql_num_rows($NextArrowResult);
		$NextArrowInfo = mysql_fetch_array($NextArrowResult);
		if ($NextArrowCount != 1)
			{
			$NextArrow = 0;
			}
		if ($place == 0 || $ref == NULL)
			{
			$PrevArrow = 0;
			}
		else
			{
			$PrevArrowResult = mysql_query($PrevArrowSQL,$dbconnect);
			$PrevArrowInfo = mysql_fetch_array($PrevArrowResult);
			$PrevPostCnt = $PrevArrowInfo['dbPostCnt'];
			
			}
		$NextPostCnt = $NextArrowInfo['dbPostCnt'];
		
		
?>