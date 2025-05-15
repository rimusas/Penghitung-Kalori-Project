function login() {
      const user = document.getElementById('username').value;
      const pass = document.getElementById('password').value;

      if (user === '' || pass === '') {
        alert('Harap isi username dan password!');
      } else {
        alert(`Login berhasil!\nUsername: ${user}`);
        // Tambahkan redirect atau autentikasi di sini
      }
    }

    function register() {
      alert('Fitur register belum tersedia.');
    }

 function addFoodRow() {
      const table = document.getElementById('food-table');
      const row = table.insertRow(-1);

      const foodCell = row.insertCell(0);
      const calorieCell = row.insertCell(1);
      const addCell = row.insertCell(2);

      foodCell.innerHTML = `<input type="text" placeholder="Nama Makanan">`;
      calorieCell.innerHTML = `<input type="number" placeholder="Kalori" class="calorie-input">`;
      addCell.innerHTML = '';
    }

    function calculateTotal() {
      let total = 0;
      const rows = document.querySelectorAll('#food-table tr');
      rows.forEach((row, index) => {
        if (index === 0) return; // Skip header
        const cell = row.cells[1];
        const input = cell.querySelector('input');
        if (input) {
          total += parseInt(input.value) || 0;
        } else {
          // Parse text value if not input
          const value = cell.textContent.replace('kkal', '').trim();
          total += parseInt(value) || 0;
        }
      });

      document.getElementById('total-calories').innerText = total + ' kkal';
    }

function addFoodRow() {
  const table = document.getElementById('food-table');
  const row = table.insertRow(-1);

  const foodCell = row.insertCell(0);
  const calorieCell = row.insertCell(1);
  const addCell = row.insertCell(2);

  foodCell.innerHTML = `<input type="text" placeholder="Nama Makanan">`;
  calorieCell.innerHTML = `<input type="number" placeholder="Kalori" class="calorie-input">`;
  addCell.innerHTML = '';
}

function calculateTotal() {
  let total = 0;
  const rows = document.querySelectorAll('#food-table tr');
  rows.forEach((row, index) => {
    if (index === 0) return; // Skip header
    const cell = row.cells[1];
    const input = cell.querySelector('input');
    if (input) {
      total += parseInt(input.value) || 0;
    } else {
      const value = cell.textContent.replace('kkal', '').trim();
      total += parseInt(value) || 0;
    }
  });

  document.getElementById('total-calories').innerText = total + ' kkal';
}

const ctx = document.getElementById('kaloriChart').getContext('2d');
    const kaloriChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['23', '24', '25', '26', '27', '28', '29'],
        datasets: [{
          label: 'Jumlah Kalori',
          data: [65, 70, 90, 80, 72, 73, 74],
          borderColor: 'black',
          backgroundColor: 'rgba(0,0,0,0.05)',
          fill: false,
          tension: 0.4,
          pointRadius: 3
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          x: {
            title: {
              display: true,
              text: 'Tanggal'
            }
          },
          y: {
            title: {
              display: true,
              text: 'Kalori (kkal)'
            },
            beginAtZero: true
          }
        }
      }
    });
 document.getElementById('register-form').addEventListener('submit', function(e) {
      e.preventDefault();

      const data = new FormData(this);
      let output = '';
      for (let [key, value] of data.entries()) {
        output += `${key}: ${value}\n`;
      }

      alert("Data berhasil didaftarkan:\n" + output);
    });
    const riwayatData = [
      {
        tanggal: '23/12/2024',
        makanan: 'Makanan 1',
        kalori: '65 kkal',
        status: 'Normal'
      },
      {
        tanggal: '24/12/2024',
        makanan: 'Makanan 2',
        kalori: '129 kkal',
        status: 'Normal'
      }
    ];

    const tbody = document.getElementById('riwayat-body');

    riwayatData.forEach(item => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${item.tanggal}</td>
        <td>${item.makanan}</td>
        <td>${item.kalori}</td>
        <td>${item.status}</td>
      `;
      tbody.appendChild(row);
    });