<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>HTML Find & Replace</title>
<style>
  body { font-family: 'Segoe UI', sans-serif; background: #f5f7fa; padding: 30px; color: #333; }
  .wrap { max-width: 900px; margin: 0 auto; }
  h1 { margin-bottom: 24px; color: #2d3748; }
  .card { background: #fff; border-radius: 12px; padding: 24px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
  label { font-weight: 600; font-size: 13px; color: #4a5568; display: block; margin-bottom: 6px; }
  textarea { width: 100%; padding: 10px 12px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 13px; font-family: monospace; resize: vertical; min-height: 100px; }
  .pair-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px; align-items: start; }
  input { width: 100%; padding: 9px 12px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; }
  .add-btn { background: transparent; color: #667eea; border: 1.5px dashed #667eea; padding: 7px 18px; border-radius: 8px; cursor: pointer; font-size: 13px; margin-top: 6px; }
  .add-btn:hover { background: #ebf4ff; }
  .del-btn { background: #fed7d7; color: #e53e3e; border: none; padding: 7px 12px; border-radius: 6px; cursor: pointer; font-size: 12px; margin-top: 2px; }
  .run-btn { background: #667eea; color: #fff; border: none; padding: 12px 30px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; margin-top: 10px; }
  .run-btn:hover { background: #5a67d8; }
  .output { margin-top: 20px; background: #f0fff4; border: 1.5px solid #9ae6b4; border-radius: 8px; padding: 14px; display: none; }
  .output label { color: #276749; }
  .output textarea { border-color: #9ae6b4; background: #f0fff4; }
</style>
</head>
<body>
<div class="wrap">
  <h1>🔍 HTML Find &amp; Replace</h1>
  <div class="card">
    <label>HTML Content</label>
    <textarea id="htmlContent" rows="6"><p align="justify" style="orphans: 0; widows: 0; margin-left: 0.39cm; margin-bottom: 0cm; border: none; padding: 0cm"><b>PARTY</b>2NAME<i>, </i>a company incorporated under the laws of ROC2LAW having its Registered Office at P1OFFICEADD. which expression, shall unless it be repugnant to the context or meaning thereof, mean and include its successors and assigns (hereinafter referred to as '' Service Provider') of the ONE PART</p></textarea>

    <div style="margin-top: 20px;">
      <label>Find &amp; Replace Pairs</label>
      <div id="pairs">
        <div class="pair-row">
          <input type="text" placeholder="Find text" value="PARTY2NAME">
          <input type="text" placeholder="Replace with" value="Abc india pvt. Ltd.">
          <button class="del-btn" onclick="removePair(this)">✕</button>
        </div>
        <div class="pair-row">
          <input type="text" placeholder="Find text" value="P1OFFICEADD.">
          <input type="text" placeholder="Replace with" value="Mount Road,chennai-60014.">
          <button class="del-btn" onclick="removePair(this)">✕</button>
        </div>
      </div>
      <button class="add-btn" onclick="addPair()">+ Add another pair</button>
    </div>

    <button class="run-btn" onclick="doReplace()">Run Replace</button>

    <div class="output" id="output">
      <label>Result:</label>
      <textarea id="resultHTML" rows="6" readonly></textarea>
      <div style="margin-top:12px;">
        <label>Rendered Preview:</label>
        <div id="preview" style="border:1px solid #9ae6b4;border-radius:8px;padding:14px;background:#fff;margin-top:6px;font-size:13px;"></div>
      </div>
    </div>
  </div>
</div>

<script>
function addPair() {
  const div = document.createElement('div');
  div.className = 'pair-row';
  div.innerHTML = `
    <input type="text" placeholder="Find text">
    <input type="text" placeholder="Replace with">
    <button class="del-btn" onclick="removePair(this)">✕</button>`;
  document.getElementById('pairs').appendChild(div);
}

function removePair(btn) {
  btn.parentElement.remove();
}

function doReplace() {
  let content = document.getElementById('htmlContent').value;
  const rows = document.querySelectorAll('#pairs .pair-row');
  rows.forEach(row => {
    const inputs = row.querySelectorAll('input');
    const find = inputs[0].value;
    const replace = inputs[1].value;
    if (find) {
      // Replace ALL occurrences
      content = content.split(find).join(replace);
    }
  });
  document.getElementById('resultHTML').value = content;
  document.getElementById('preview').innerHTML = content;
  document.getElementById('output').style.display = 'block';
}
</script>
</body>
</html>

<?php
/* ===== PHP VERSION =====
$htmlContent = '<p align="justify" style="..."><b>PARTY</b>2NAME...</p>';

$findReplace = [
    'PARTY2NAME'  => 'Abc india pvt. Ltd.',
    'P1OFFICEADD.' => 'Mount Road,chennai-60014.'
];

// str_replace handles arrays directly
$result = str_replace(
    array_keys($findReplace),
    array_values($findReplace),
    $htmlContent
);

echo $result;
*/
?>