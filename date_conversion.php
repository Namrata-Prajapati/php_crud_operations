<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Days Between Dates</title>
<style>
  body { font-family: 'Segoe UI', sans-serif; background: #f0f4f8; padding: 40px 16px; color: #333; }
  .wrap { max-width: 520px; margin: 0 auto; }
  h1 { margin-bottom: 24px; color: #2d3748; }
  .card { background: #fff; border-radius: 12px; padding: 28px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
  label { font-weight: 600; font-size: 13px; color: #4a5568; display: block; margin-bottom: 6px; }
  input { width: 100%; padding: 11px 13px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 15px; margin-bottom: 16px; }
  .btn { background: #667eea; color: #fff; border: none; padding: 12px 30px; border-radius: 8px; font-size: 14px; font-weight: 700; cursor: pointer; width: 100%; transition: background 0.2s; }
  .btn:hover { background: #5a67d8; }
  .result { margin-top: 20px; background: #ebf4ff; border-radius: 10px; padding: 20px; display: none; }
  .result .num { font-size: 40px; font-weight: 800; color: #3182ce; }
  .result .label { font-size: 14px; color: #718096; margin-bottom: 10px; }
  .result .words { font-size: 16px; color: #2d3748; font-style: italic; margin-top: 6px; }
  .error { color: #e53e3e; font-size: 13px; margin-top: 8px; display: none; }
</style>
</head>
<body>
<div class="wrap">
  <h1>📅 Days Between Dates</h1>
  <div class="card">
    <label>Start Date</label>
    <input type="date" id="date1" value="2022-12-26">
    <label>End Date</label>
    <input type="date" id="date2" value="2024-12-29">
    <button class="btn" onclick="calcDays()">Calculate</button>
    <div class="error" id="err">End date must be after start date.</div>
    <div class="result" id="result">
      <div class="label">Days between the dates:</div>
      <div class="num" id="numDays"></div>
      <div style="font-size:16px;color:#3182ce;font-weight:600">Days</div>
      <div class="words" id="wordDays"></div>
    </div>
  </div>
</div>

<script>
const ones = ['','one','two','three','four','five','six','seven','eight','nine',
               'ten','eleven','twelve','thirteen','fourteen','fifteen','sixteen',
               'seventeen','eighteen','nineteen'];
const tens = ['','','twenty','thirty','forty','fifty','sixty','seventy','eighty','ninety'];

function toWords(n) {
  if (n === 0) return 'zero';
  if (n < 0) return 'negative ' + toWords(-n);
  if (n < 20) return ones[n];
  if (n < 100) return tens[Math.floor(n/10)] + (n%10 ? ' ' + ones[n%10] : '');
  if (n < 1000) return ones[Math.floor(n/100)] + ' hundred' + (n%100 ? ' ' + toWords(n%100) : '');
  if (n < 1000000) {
    return toWords(Math.floor(n/1000)) + ' thousand' + (n%1000 ? ' ' + toWords(n%1000) : '');
  }
  return toWords(Math.floor(n/1000000)) + ' million' + (n%1000000 ? ' ' + toWords(n%1000000) : '');
}

function calcDays() {
  const d1 = new Date(document.getElementById('date1').value);
  const d2 = new Date(document.getElementById('date2').value);
  const errEl = document.getElementById('err');
  const resEl = document.getElementById('result');

  if (d2 <= d1) {
    errEl.style.display = 'block';
    resEl.style.display = 'none';
    return;
  }
  errEl.style.display = 'none';

  const diffMs = d2 - d1;
  const days = Math.round(diffMs / (1000 * 60 * 60 * 24));
  const wordsStr = toWords(days) + ' Days';

  document.getElementById('numDays').textContent = days;
  document.getElementById('wordDays').textContent = wordsStr.charAt(0).toUpperCase() + wordsStr.slice(1);
  resEl.style.display = 'block';
}

calcDays(); // auto-calculate with defaults
</script>
</body>
</html>

<?php
/* ===== PHP VERSION =====
function numberToWords($n) {
    $ones = ['','one','two','three','four','five','six','seven','eight','nine',
             'ten','eleven','twelve','thirteen','fourteen','fifteen','sixteen',
             'seventeen','eighteen','nineteen'];
    $tens = ['','','twenty','thirty','forty','fifty','sixty','seventy','eighty','ninety'];
    if ($n == 0) return 'zero';
    if ($n < 20) return $ones[$n];
    if ($n < 100) return $tens[(int)($n/10)] . ($n%10 ? ' ' . $ones[$n%10] : '');
    if ($n < 1000) return $ones[(int)($n/100)] . ' hundred' . ($n%100 ? ' ' . numberToWords($n%100) : '');
    if ($n < 1000000) return numberToWords((int)($n/1000)) . ' thousand' . ($n%1000 ? ' ' . numberToWords($n%1000) : '');
    return '';
}

$date1 = new DateTime('2022-12-26');
$date2 = new DateTime('2024-12-29');
$diff  = $date1->diff($date2);
$days  = $diff->days;
$words = ucfirst(numberToWords($days));

echo "$days Days\n";
echo "$words Days\n";
// Output: 734 Days
//         Seven hundred thirty four Days
*/
?>