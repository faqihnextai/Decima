// Pengendali Pemilihan File & Kamera Langsung
function triggerPhoto(source) {
    if (source === 'camera') {
        const cam = document.getElementById('cameraInput');
        cam.value = '';
        cam.click();
    } else {
        const file = document.getElementById('portfolioImage');
        file.value = '';
        file.click();
    }
}

// Salin file dari kamera ke form submission utama
document.getElementById('cameraInput').addEventListener('change', function (e) {
    if (e.target.files && e.target.files[0]) {
        const dt = new DataTransfer();
        dt.items.add(e.target.files[0]);
        document.getElementById('portfolioImage').files = dt.files;
        showPreview(e.target.files[0]);
    }
});

document.getElementById('portfolioImage').addEventListener('change', function (e) {
    if (e.target.files && e.target.files[0]) {
        showPreview(e.target.files[0]);
    }
});

function showPreview(file) {
    const reader = new FileReader();
    reader.onload = function (e) {
        const img = document.getElementById('imagePreview');
        img.src = e.target.result;
        document.getElementById('previewContainer').classList.remove('d-none');
    };
    reader.readAsDataURL(file);
}

// Kontrol Posisi Fokus Gambar
function setImagePosition(pos) {
    const img = document.getElementById('imagePreview');
    img.style.objectPosition = pos;
    document.getElementById('portfolioImagePosition').value = pos;

    const buttons = document.querySelectorAll('#previewContainer .btn-group button');
    buttons.forEach(btn => {
        const text = btn.textContent.toLowerCase();
        const activeCondition = (pos === 'top' && text === 'atas') ||
                               (pos === 'center' && text === 'tengah') ||
                               (pos === 'bottom' && text === 'bawah');
        btn.classList.toggle('active', activeCondition);
    });
}

// Toolbar Rich Text
function formatText(cmd) {
    document.execCommand(cmd, false, null);
    document.getElementById('richEditor').focus();
}

function formatHeading() {
    document.execCommand('formatBlock', false, '<h3>');
    document.getElementById('richEditor').focus();
}

// Sinkronisasi data HTML editor ke textarea hidden sebelum form dikirim
document.getElementById('portfolioForm').addEventListener('submit', function () {
    document.getElementById('portfolioDesc').value = document.getElementById('richEditor').innerHTML;
});

// Edit Data Portofolio
function editData(data) {
    document.getElementById('formTitle').innerText = 'Edit Berita / Proyek';
    document.getElementById('portfolioId').value = data.id;
    document.getElementById('portfolioTitle').value = data.title;
    document.getElementById('portfolioDate').value = data.date || data.created_at || '';
    
    document.getElementById('richEditor').innerHTML = data.description || '';
    document.getElementById('portfolioDesc').value = data.description || '';
    
    document.getElementById('portfolioExistingImage').value = data.image || '';
    const pos = data.image_position || 'center';
    setImagePosition(pos);

    if (data.image) {
        document.getElementById('imagePreview').src = '/uploads/portfolio/' + data.image;
        document.getElementById('previewContainer').classList.remove('d-none');
        document.getElementById('imageHelp').innerText = 'Gambar saat ini: ' + data.image + ' (Biarkan kosong jika tidak ganti)';
    } else {
        document.getElementById('previewContainer').classList.add('d-none');
        document.getElementById('imageHelp').innerText = 'Format: JPG, PNG, WEBP.';
    }

    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Reset Form
function resetForm() {
    document.getElementById('formTitle').innerText = 'Tambah Berita / Proyek';
    document.getElementById('portfolioId').value = '';
    document.getElementById('portfolioTitle').value = '';
    document.getElementById('portfolioDate').value = new Date().toISOString().split('T')[0];
    document.getElementById('richEditor').innerHTML = '';
    document.getElementById('portfolioDesc').value = '';
    document.getElementById('portfolioExistingImage').value = '';
    document.getElementById('portfolioImage').value = '';
    document.getElementById('cameraInput').value = '';
    document.getElementById('previewContainer').classList.add('d-none');
    document.getElementById('imageHelp').innerText = 'Format: JPG, PNG, WEBP.';
    setImagePosition('center');
}