<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Management System</title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Segoe UI', sans-serif; background: #f0f4f8; color: #333; }
  .container { max-width: 1100px; margin: 30px auto; padding: 0 20px; }
  h1 { text-align: center; margin-bottom: 24px; color: #2d3748; font-size: 26px; }
  .card { background: #fff; border-radius: 12px; padding: 28px; margin-bottom: 30px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
  .card h2 { margin-bottom: 20px; font-size: 18px; color: #4a5568; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; }
  .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
  .form-group { display: flex; flex-direction: column; gap: 6px; }
  .form-group.full { grid-column: span 2; }
  label { font-size: 13px; font-weight: 600; color: #4a5568; }
  input, select { padding: 10px 12px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; transition: border-color 0.2s; }
  input:focus, select:focus { outline: none; border-color: #667eea; }
  input.error, select.error { border-color: #e53e3e; }
  .error-msg { font-size: 11px; color: #e53e3e; margin-top: 2px; }
  .btn { background: #667eea; color: #fff; border: none; padding: 12px 28px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: background 0.2s; }
  .btn:hover { background: #5a67d8; }
  .btn-wrap { text-align: center; margin-top: 20px; }
  #message { text-align: center; margin-top: 14px; font-size: 14px; font-weight: 600; }
  .success { color: #38a169; }
  .fail { color: #e53e3e; }
  table { width: 100%; border-collapse: collapse; font-size: 13px; }
  th { background: #667eea; color: #fff; padding: 10px 12px; text-align: left; }
  td { padding: 9px 12px; border-bottom: 1px solid #e2e8f0; }
  tr:hover td { background: #f7fafc; }
  .badge { padding: 2px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; }
  .badge-m { background: #bee3f8; color: #2b6cb0; }
  .badge-f { background: #fed7e2; color: #97266d; }
  #tableWrap { overflow-x: auto; }
</style>
</head>
<body>
<div class="container">
  <h1>🎓 Student Management System</h1>

  <div class="card">
    <h2>Add New Student</h2>
    <div class="form-grid">
      <div class="form-group">
        <label>Full Name *</label>
        <input type="text" id="name" placeholder="Enter student name">
        <span class="error-msg" id="err_name"></span>
      </div>
      <div class="form-group">
        <label>Gender *</label>
        <select id="gender">
          <option value="">-- Select Gender --</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Other">Other</option>
        </select>
        <span class="error-msg" id="err_gender"></span>
      </div>
      <div class="form-group">
        <label>Standard / Class *</label>
        <input type="text" id="standard" placeholder="e.g. 10th">
        <span class="error-msg" id="err_standard"></span>
      </div>
      <div class="form-group">
        <label>Date of Birth *</label>
        <input type="date" id="dob" onchange="calcAge()">
        <span class="error-msg" id="err_dob"></span>
      </div>
      <div class="form-group">
        <label>Age (Auto-calculated) *</label>
        <input type="number" id="age" placeholder="Auto-calculated from DOB" readonly>
        <span class="error-msg" id="err_age"></span>
      </div>
      <div class="form-group">
        <label>Email *</label>
        <input type="email" id="email" placeholder="student@email.com">
        <span class="error-msg" id="err_email"></span>
      </div>
      <div class="form-group">
        <label>Father's Name *</label>
        <input type="text" id="father_name" placeholder="Father's full name">
        <span class="error-msg" id="err_father_name"></span>
      </div>
      <div class="form-group">
        <label>Father's Mobile Number *</label>
        <input type="text" id="father_mobile" placeholder="10-digit mobile number" maxlength="10">
        <span class="error-msg" id="err_father_mobile"></span>
      </div>
    </div>
    <div class="btn-wrap">
      <button class="btn" onclick="submitStudent()">Add Student</button>
    </div>
    <div id="message"></div>
  </div>

  <div class="card">
    <h2>Student List</h2>
    <div id="tableWrap">Loading...</div>
  </div>
</div>

<script>
function calcAge() {
  const dob = document.getElementById('dob').value;
  if (!dob) return;
  const today = new Date();
  const birthDate = new Date(dob);
  let age = today.getFullYear() - birthDate.getFullYear();
  const m = today.getMonth() - birthDate.getMonth();
  if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
  document.getElementById('age').value = age;
}

function clearErrors() {
  ['name','gender','standard','dob','age','email','father_name','father_mobile'].forEach(f => {
    document.getElementById('err_'+f).textContent = '';
    const el = document.getElementById(f);
    if (el) el.classList.remove('error');
  });
}

function setError(field, msg) {
  document.getElementById('err_'+field).textContent = msg;
  document.getElementById(field).classList.add('error');
}

function validate() {
  clearErrors();
  let valid = true;
  const name = document.getElementById('name').value.trim();
  const gender = document.getElementById('gender').value;
  const standard = document.getElementById('standard').value.trim();
  const dob = document.getElementById('dob').value;
  const age = document.getElementById('age').value;
  const email = document.getElementById('email').value.trim();
  const fatherName = document.getElementById('father_name').value.trim();
  const mobile = document.getElementById('father_mobile').value.trim();

  if (!name) { setError('name', 'Name is required.'); valid = false; }
  if (!gender) { setError('gender', 'Gender is required.'); valid = false; }
  if (!standard) { setError('standard', 'Standard is required.'); valid = false; }
  if (!dob) { setError('dob', 'Date of Birth is required.'); valid = false; }
  if (!age) { setError('age', 'Age is required (select a DOB).'); valid = false; }
  if (!email) { setError('email', 'Email is required.'); valid = false; }
  else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { setError('email', 'Invalid email format.'); valid = false; }
  if (!fatherName) { setError('father_name', "Father's name is required."); valid = false; }
  if (!mobile) { setError('father_mobile', 'Mobile number is required.'); valid = false; }
  else if (!/^\d{10}$/.test(mobile)) { setError('father_mobile', 'Mobile must be exactly 10 digits.'); valid = false; }

  return valid;
}

function submitStudent() {
  if (!validate()) return;

  const data = {
    name: document.getElementById('name').value.trim(),
    gender: document.getElementById('gender').value,
    standard: document.getElementById('standard').value.trim(),
    dob: document.getElementById('dob').value,
    age: document.getElementById('age').value,
    email: document.getElementById('email').value.trim(),
    father_name: document.getElementById('father_name').value.trim(),
    father_mobile: document.getElementById('father_mobile').value.trim()
  };

  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'save_student.php', true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      const res = JSON.parse(xhr.responseText);
      const msgEl = document.getElementById('message');
      if (res.success) {
        msgEl.className = 'success';
        msgEl.textContent = '✅ Student added successfully!';
        document.querySelectorAll('input, select').forEach(el => el.value = '');
        loadStudents();
      } else {
        msgEl.className = 'fail';
        msgEl.textContent = '❌ Error: ' + res.message;
      }
    }
  };
  xhr.send(JSON.stringify(data));
}

function loadStudents() {
  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'get_students.php', true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      const students = JSON.parse(xhr.responseText);
      const wrap = document.getElementById('tableWrap');
      if (!students.length) { wrap.innerHTML = '<p style="text-align:center;color:#999;padding:20px">No students found.</p>'; return; }
      let html = `<table><thead><tr>
        <th>#</th><th>Name</th><th>Gender</th><th>Standard</th><th>DOB</th><th>Age</th>
        <th>Email</th><th>Father Name</th><th>Father Mobile</th>
      </tr></thead><tbody>`;
      students.forEach((s, i) => {
        const badge = s.gender === 'Male' ? 'badge-m' : (s.gender === 'Female' ? 'badge-f' : '');
        html += `<tr>
          <td>${i+1}</td>
          <td><strong>${s.name}</strong></td>
          <td><span class="badge ${badge}">${s.gender}</span></td>
          <td>${s.standard}</td>
          <td>${s.dob}</td>
          <td>${s.age}</td>
          <td>${s.email}</td>
          <td>${s.father_name}</td>
          <td>${s.father_mobile}</td>
        </tr>`;
      });
      html += '</tbody></table>';
      wrap.innerHTML = html;
    }
  };
  xhr.send();
}

loadStudents();
</script>
</body>
</html>