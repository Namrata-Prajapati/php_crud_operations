<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>String Replace Tool</title>
<style>
  body { font-family: 'Segoe UI', sans-serif; background: #f5f7fa; padding: 30px; color: #333; }
  .wrap { max-width: 850px; margin: 0 auto; }
  h1 { margin-bottom: 24px; color: #2d3748; }
  .card { background: #fff; border-radius: 12px; padding: 24px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
  label { font-weight: 600; font-size: 13px; color: #4a5568; display: block; margin-bottom: 6px; }
  input, textarea { width: 100%; padding: 10px 12px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; margin-bottom: 14px; }
  textarea { resize: vertical; min-height: 120px; font-family: monospace; }
  .btn { background: #48bb78; color: #fff; border: none; padding: 11px 26px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; }
  .btn:hover { background: #38a169; }
  #output { background: #f0fff4; border: 1.5px solid #9ae6b4; border-radius: 8px; padding: 14px; font-family: monospace; font-size: 13px; white-space: pre-wrap; word-break: break-word; margin-top: 16px; display: none; }
  .pair { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
</style>
</head>
<body>
<div class="wrap">
  <h1>🔠 String Placeholder Replacer</h1>
  <div class="card">
    <label>Template String (use @Placeholder@ syntax)</label>
    <textarea id="template">@Name@ ipsum dolor sit amet, consectetur adipiscing elit. Praesent in mollis magna. Donec eu elit pellentesque, maximus nisl vitae, cursus velit. Sed Loremnibh sed elit auctor tincidunt. Donec tempor est id nunc ullamcorper rhoncus. Phasellus nec arcu et dui varius ullamcorper commodo quis ligula. Etiam ultrices nisi @email@, ut euismod elit tempor sed. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque auctor turpis vel nisi fermentum, a sodales magna egestas. Vestibulum lobortis elit sed neque rhoncus, sit amet @mobile@ magna blandit. @designation@ nec leo ac diam euismod fringilla.</textarea>

    <label>Replacement Values</label>
    <div class="pair">
      <div>
        <label>Name</label>
        <input type="text" id="r_name" value="RRRR" placeholder="@Name@">
      </div>
      <div>
        <label>Email</label>
        <input type="text" id="r_email" value="RRR@RRR.com" placeholder="@email@">
      </div>
      <div>
        <label>Mobile</label>
        <input type="text" id="r_mobile" value="9988775566" placeholder="@mobile@">
      </div>
      <div>
        <label>Designation</label>
        <input type="text" id="r_designation" value="Software Developer" placeholder="@designation@">
      </div>
    </div>
    <button class="btn" onclick="doReplace()">Replace Placeholders</button>
    <div id="output"></div>
  </div>
</div>

<script>
function doReplace() {
  let str = document.getElementById('template').value;
  const replacements = {
    '@Name@': document.getElementById('r_name').value,
    '@email@': document.getElementById('r_email').value,
    '@mobile@': document.getElementById('r_mobile').value,
    '@designation@': document.getElementById('r_designation').value
  };
  // Case-insensitive replacement using regex
  for (const [placeholder, value] of Object.entries(replacements)) {
    const escaped = placeholder.replace(/[@]/g, '\\@');
    const regex = new RegExp(escaped, 'gi');
    str = str.replace(regex, value);
  }
  const out = document.getElementById('output');
  out.style.display = 'block';
  out.textContent = str;
}
</script>
</body>
</html>

<?php
/* ===== PHP VERSION =====
$string = "@Name@ ipsum dolor sit amet..."; // full string here

$name        = "RRRR";
$email       = "RRR@RRR.com";
$mobile      = "9988775566";
$designation = "Software Developer";

// Simple str_replace approach (case-sensitive)
$string = str_replace(['@Name@', '@email@', '@mobile@', '@designation@'],
                      [$name, $email, $mobile, $designation],
                      $string);
echo $string;

// Alternative: case-insensitive using str_ireplace
$string2 = str_ireplace(['@Name@', '@email@', '@mobile@', '@designation@'],
                        [$name, $email, $mobile, $designation],
                        $string);
echo $string2;
*/
?>