<?
// $Id: mod.php,v 1.7 2003/05/21 22:44:51 chavan Exp $


/* Description:   Loads item data from database for editing
 *                Passes the data to uipublish_admin/preview.php
 */
?>

<? $wysiwyg = "true"; ?>
<? include ("inc/top.php") ?>

<?

if ($id <> "") {
    get_adminitem($id);
} else {
    echo display_err("Please specify an ID.");
    exit();
}
?>

<h2>Modify <? echo $section[$section_id]; ?> - Item #<? echo $id; ?></h2>

<form name="mod_form" action="preview.php" method="post">
<input type="checkbox" name="copy" value="ON"> <b>Create a copy of this Entry instead?</b>

<table border="0">
 <tr valign="top">
  <td><label for="title">Title:</label><font color="#ff0000">*</font></td>
  <td colspan="3">
<? 
echo "<input type=\"text\" name=\"title\" id=\"title\" 
size=\"80\" maxlength=\"200\" value=\"" 
. stripslashes($title) . "\">"; 
?>
  </td>
 </tr>

 <tr valign="top">
  <td><label for="post_month">Post Date:</label><font color="#ff0000">*</font></td>
  <td><pre><? echo format_date2form($post_date, "post"); ?></pre></td>
  <td><label for="expire_month">Expire Date:</label></td>
  <td><pre><? echo format_date2form($expire_date, "expire"); ?></pre></td>
 </tr>
 
 <tr valign="top">
  <td><label for="summary">Summary:</label><br><font size=-2 color=#666666>[Teaser on Front Page.]</font></td>
  <td colspan="3">  
<? 
echo "<textarea name=\"summary\" id=\"summary\"
cols=\"100\" rows=\"3\" maxlength=\"255\" wrap=\"soft\">" 
. stripslashes($summary) . "</textarea>"; 
?>
  </td>
 </tr>

 <tr valign="top">
  <td>&nbsp;</td>
  <td><Input Type = Button Name = b1 value = "   Trim    " onClick = "document.add_form.summary.value = stripIt(document.add_form.summary.value,250)"></td>
  <td><Input Type = Button Name = b2 value = "   /\    " onClick = "document.add_form.summary.value = stripIt(document.add_form.content.value, 250)"></td>
 </tr>

 <tr valign="top">
  <td><label for="content">Content:</label></td>
  <td colspan="3">  
<? 
echo "<textarea name=\"content\" id=\"content\"
cols=\"100\" rows=\"12\" wrap=\"soft\">" 
. stripslashes($content) . "</textarea><br>"; 
?>
  </td>
 </tr>
 
 
 <tr valign="top">
  <td><label for="link_url">Link URL:</label><br><font size=-2 color=#666666>[Send user to a URL]</font></td>
  <td colspan="3">
<? 
echo "<input type=\"text\" name=\"link_url\" id=\"link_url\"
size=\"80\" maxlength=\"200\" value=\"" 
. stripslashes($link_url) . "\">"; 
?>
  </td>
 </tr>
 
 <tr valign="top">
  <td><label for="file">Enclosure/<br>PodCast file:</label></td>
  <td colspan="3">
<? 
echo "<input class=\"kfm\" id=\"file\" type=\"text\" name=\"filepath\" 
size=\"80\" maxlength=\"200\" value=\"" 
. stripslashes($filepath) . "\">"; 
?>
  </td>
 </tr>
 
 <tr valign="top">
  <td><label for="status">Status:</label></td>
  <td>
<?
switch ($status) {
 case "1" :
    echo "<label for=\"status\">Draft:</label>&nbsp;<input type=\"radio\" value=\"2\" name=\"status\" id=\"status\">&nbsp;&nbsp;";
    echo "<label for=\"status2\">Publish:</label>&nbsp;<input type=\"radio\" checked name=\"status\" id=\"status2\" value=\"1\">";
    break;
 default :
    echo "<label for=\"status\">Draft:</label>&nbsp;<input type=\"radio\" value=\"2\" checked name=\"status\" id=\"status\">&nbsp;&nbsp;";
    echo "<label for=\"status2\">Publish:</label>&nbsp;<input type=\"radio\" name=\"status\" id=\"status2\" value=\"1\">";    
    break;
}
?>
  </td>
  <td><label for="topic_id">Category:</label></td>
  <td><select name="topic_id" id="topic_id">
<? 
 $topic_count = count($topic);
 if ($topic_id == "") {
   echo ("<option selected value=\"\">None</option>\n");
   } else {
     echo ("<option value=\"\">None</option>\n");
   }
 for ($idx = 0; $idx < $topic_count; ++$idx) {
   if ($idx == $topic_id) {
     if ($topic_id != "") {
       echo ("<option selected value=\"$idx\">$topic[$idx]</option>\n");
     } else {
       echo ("<option value=\"$idx\">$topic[$idx]</option>\n");
     } 
   } else {
     echo ("<option value=\"$idx\">$topic[$idx]</option>\n");
   }
  }

?> 
  </select></td>
 </tr>

 <tr valign="top">
  <td><label for="weight">Front Page:</label></td>
  <td>
<?
switch ($weight) {
 case "1" :
    echo "<label for=\"weight\">Yes:</label>&nbsp;<input type=\"radio\" value=\"1\" checked name=\"weight\" id=\"weight\">&nbsp;&nbsp;";
    echo "<label for=\"weight2\">No:</label>&nbsp;<input type=\"radio\" name=\"weight\" id=\"weight2\" value=\"2\">";
    break;
 default :
    echo "<label for=\"weight\">Yes:</label>&nbsp;Yes:<input type=\"radio\" value=\"1\" name=\"weight\" id=\"weight\">&nbsp;&nbsp;";
    echo "<label for=\"weight2\">No:</label>&nbsp;<input type=\"radio\" checked name=\"weight\" id=\"weight2\" value=\"2\">";    
    break;
}
?>
  </td>  <td><label for="section_id">Section:</label></td>
  <td><select name="section_id" id="section_id">
<? 
 $section_count = count($section);
 for ($idx = 0; $idx < $section_count; ++$idx) {
     if ($idx == $section_id) {
	 echo ("<option selected value=\"$idx\">$section[$idx]</option>\n");
     } else {
	 echo ("<option value=\"$idx\">$section[$idx]</option>\n");
     }
 }
?> 
  </select></td>
 </tr>
 
 <tr valign="top">
  <td colspan="4"><center><input type="submit" value="Preview"></center></td>
 </tr>
 
</table> 
<input type="hidden" name="id" value="<? echo $id; ?>">
</form>

<? $datepop = "true"; $timepop = ""; ?>
<? include ("inc/bot.php") ?>
