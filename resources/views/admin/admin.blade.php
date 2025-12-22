<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin Dashboard - KNiverse</title>
   @vite(['resources/css/admin.css'])
  <style>
   
  </style>
</head>
<body>
  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <div class="logo-admin">
      <img src="{{ asset('image/logoUsaha.png') }}" alt="Logo" onerror="this.style.display='none'">
      <h2>KNiverse Admin</h2>
    </div>

    <div class="menu-item active" data-tab="dashboard" onclick="switchTab('dashboard')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="3" width="7" height="7"></rect>
        <rect x="14" y="3" width="7" height="7"></rect>
        <rect x="14" y="14" width="7" height="7"></rect>
        <rect x="3" y="14" width="7" height="7"></rect>
      </svg>
      Dashboard
    </div>

    <div class="menu-item" data-tab="products" onclick="switchTab('products')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
        <line x1="3" y1="9" x2="21" y2="9"></line>
        <line x1="9" y1="21" x2="9" y2="9"></line>
      </svg>
      Produk
    </div>

    <div class="menu-item" data-tab="orders" onclick="switchTab('orders')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="9" cy="21" r="1"></circle>
        <circle cx="20" cy="21" r="1"></circle>
        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
      </svg>
      Pesanan
    </div>

    <div class="menu-item" data-tab="addproduct" onclick="switchTab('addproduct')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
      Tambah Produk
    </div>
    <div class="menu-item" data-tab="vouchers" onclick="switchTab('vouchers')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M4 4h16v2H4z"></path>
        <path d="M4 12h16v8H4z"></path>
        <line x1="4" y1="9" x2="20" y2="9"></line>
      </svg>
      Kelola Voucher
    </div>

    <div class="menu-item" onclick="window.location.href='{{ url('/market/home') }}'" style="margin-top: 20px; border-top: 1px solid var(--border); padding-top: 20px;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
        <polyline points="16 17 21 12 16 7"></polyline>
        <line x1="21" y1="12" x2="9" y2="12"></line>
      </svg>
      Ke Website
    </div>

    <div class="menu-item" onclick="window.location.href='{{ url('/admin/login') }}'" style="margin-top: 20px; border-top: 1px solid var(--border); padding-top: 20px;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
        <polyline points="16 17 21 12 16 7"></polyline>
        <line x1="21" y1="12" x2="9" y2="12"></line>
      </svg>
      Logout
    </div>
  </aside>

  <!-- Main Content -->
<main class="main-content">
  <!-- Alert -->
  <div id="alert" class="alert"></div>

  <!-- Header -->
  <div class="header">
    <h1 id="pageTitle">Dashboard</h1>

    <div class="user-info">
      <div class="user-avatar">
        {{ strtoupper(substr(session('nama_user'), 0, 1)) }}
      </div>

      <div>
        <div style="font-weight: 600;">
          {{ session('nama_user') }}
        </div>
        <div style="font-size: 0.85rem; color: #666;">
          {{ session('email') }}
        </div>
      </div>
    </div>
  </div>

  <!-- ================= Dashboard Tab ================= -->
  <div id="dashboardTab" class="tab-content active">
    <div class="stats-grid">
      <div class="stat-card">
        <h3>Total Produk</h3>
        <div class="value" id="totalProducts">0</div>
        <div class="trend">↑ Aktif</div>
      </div>

      <div class="stat-card">
        <h3>Total Pesanan</h3>
        <div class="value" id="totalOrders">0</div>
        <div class="trend">↑ Semua waktu</div>
      </div>

      <div class="stat-card">
        <h3>Pesanan Hari Ini</h3>
        <div class="value" id="todayOrders">0</div>
        <div class="trend">↑ Hari ini</div>
      </div>

      <div class="stat-card">
        <h3>Total Pendapatan</h3>
        <div class="value" id="totalRevenue">Rp 0</div>
        <div class="trend">↑ Semua waktu</div>
      </div>
    </div>

    <div class="form-section">
      <h3 style="margin-bottom: 15px; color: var(--orange);">Aktivitas Terbaru</h3>
      <div id="recentActivity">
        <p style="color: #666;">Memuat aktivitas...</p>
      </div>
    </div>
  </div>

  <!-- ================= Products Tab ================= -->
  <div id="productsTab" class="tab-content">
    <div style="margin-bottom: 20px;">
      <button class="btn btn-primary" onclick="switchTab('addproduct')">
        + Tambah Produk Baru
      </button>
    </div>

    <div class="product-grid" id="productList">
      <!-- Products loaded here -->
    </div>
  </div>

  <!-- ================= Orders Tab ================= -->
  <div id="ordersTab" class="tab-content">
    <div class="orders-table">
      <table>
        <thead>
          <tr>
            <th>Nama</th>
            <th>Produk</th>
            <th>Alamat</th>
            <th>Catatan</th>
            {{-- <th>Subtotal</th> --}}
            <th>Total</th>
            <th>Voucher</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="ordersTableBody">
          @foreach ($toko as $item)
            <tr data-id="{{ $item->id }}">
              <td>{{ $item->nama }}</td>
              <td>{{ $item->produk }}</td>
              <td>{{ $item->alamat }}</td>
              <td>{{ $item->catatan ?? '-' }}</td>
              {{-- <td>Rp {{ number_format($item->original_total ?? $item->total, 0, ',', '.') }}</td> --}}
              <td >Rp {{ number_format($item->total, 0, ',', '.') }}</td>
              <td>{{ $item->voucher_code ? $item->voucher_code : '-' }}</td>
              <td>
                <button class="btn btn-delete" onclick="deleteOrder({{ $item->id }})">
                  Hapus
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- ================= Add Product Tab ================= -->
  <div id="addproductTab" class="tab-content">
    <div class="form-section">
      <h3 style="margin-bottom: 20px; color: var(--orange);">Tambah Produk Baru</h3>

      <form id="addProductForm">
        <div class="form-group">
          <label>Nama Produk *</label>
          <input type="text" id="productName" required placeholder="Contoh: Dimsum Chili Oil">
        </div>

        <div class="form-group">
          <label>Deskripsi *</label>
          <textarea id="productDesc" required placeholder="Deskripsi produk..."></textarea>
        </div>

        <div class="form-group">
          <label>Harga (Rp) *</label>
          <input type="number" id="productPrice" required min="0" placeholder="15000">
        </div>

        <div class="form-group">
          <label>Upload Gambar *</label>
          <input
            type="file"
            id="productImageFile"
            accept="image/*"
            required
            onchange="previewImageUpload()"
          >

          <div class="image-preview" id="imagePreview">
            <div class="image-preview-text">
              Preview gambar akan muncul di sini
            </div>
          </div>

          <input type="hidden" id="productImage" required>
        </div>
           <!-- paket produk -->
            <div class="form-group">
            <label>Kategori Produk *</label>
            <select id="productCategory" required style="padding:12px;border:1px solid var(--border);border-radius:8px;width:100%;max-width:320px;" onchange="updateIncludesInputVisibility()">
              <option value="andalan">⭐ Menu Andalan</option>
              <option value="utama" selected>🍽️ Menu Utama</option>
              <option value="secret">🎁 Secret Paket</option>
            </select>
            <div id="bundleCountInfo" style="display:none;margin-top:10px;padding:12px;background:#fffbf5;border-left:4px solid var(--orange);border-radius:6px;color:#666;font-size:0.9rem;">

            <!-- Bundle Creation Form (hanya muncul jika pilih Secret Paket) -->
            <div id="bundleFormSection" style="display:none;padding:16px;background:#fffbf5;border-radius:10px;border:1px solid var(--border);margin-bottom:16px;">
              <h4 style="color:var(--orange);margin-top:0;">🎁 Buat Bundling Baru</h4>
            
              <div class="form-group">
                <label>Nama Bundling *</label>
                <input type="text" id="bundleName" placeholder="Contoh: Paket Ngecrush" oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s\-]/g, '')">
              </div>

              <div class="form-group">
                <label>Deskripsi Bundling *</label>
                <input type="text" id="bundleDesc" placeholder="Contoh: Paket romantis untuk yang lagi ngecrush">
              </div>

              <div class="form-group">
                <label>Diskon Bundling (%) *</label>
                <input type="number" id="bundleDiscount" placeholder="10" min="0" max="100">
              </div>

              <div class="form-group">
                <label>Harga Paket (Rp) *</label>
                <input type="number" id="bundlePrice" placeholder="15000" min="0">
              </div>

              <div class="form-group">
                <label>Upload Gambar Paket</label>
                <input type="file" id="bundleImageFile" accept="image/*" onchange="previewBundleImageUpload()">
                <div class="image-preview" id="bundleImagePreview">
                  <div class="image-preview-text">Preview gambar paket akan muncul di sini</div>
                </div>
                <input type="hidden" id="bundleImage">
              </div>

              <div class="form-group">
                <label>Isi Paket *</label>
                <div id="bundleItemsContainer" style="border:1px solid var(--border);border-radius:8px;padding:12px;background:white;max-height:300px;overflow-y:auto;">
                  <div id="bundleItemsList" style="display:flex;flex-direction:column;gap:8px;">
                    <!-- Bundle items akan ditambahkan di sini -->
                  </div>
                  <button type="button" class="btn btn-primary" style="width:100%;margin-top:12px;padding:8px;font-size:0.9rem;" onclick="addBundleItemSlot()">+ Tambah Item</button>
                </div>
              </div>

              <div class="form-group" style="background:#f5f5f5;padding:12px;border-radius:8px;border-left:4px solid var(--orange);">
                <label style="font-weight:600;margin-bottom:8px;display:block;">📦 Preview Bundle:</label>
                <div id="bundlePreview" style="color:#444;font-size:0.9rem;min-height:20px;background:white;padding:10px;border-radius:6px;border:1px dashed var(--border);">Belum ada item</div>
              </div>

              <button type="button" class="btn btn-primary" onclick="createBundle()" style="margin-right:8px;">✨ Buat Bundling</button>
              <button type="button" class="btn" style="background:var(--gray);" onclick="cancelBundleForm()">Batal</button>
            </div>
            </div>
          </div>

        <button type="submit" class="btn btn-primary">Simpan Produk</button>
        <button
          type="button"
          class="btn"
          style="background: var(--gray); margin-left: 10px;"
          onclick="resetForm()"
        >
          Reset Form
        </button>
      </form>
    </div>
  </div>
  <!-- ================= Vouchers Tab ================= -->
  <div id="vouchersTab" class="tab-content">
    <div class="form-section">
      {{-- <h3 style="margin-bottom: 16px; color: var(--orange);">Kelola Voucher</h3> --}}

      <div class="vouchers-row">
        <!-- ===== Form Tambah Voucher ===== -->
        <div class="form-col">
          <form id="addVoucherForm">
            <div class="form-group">
              <label>Kode Voucher *</label>
              <input
                type="text" id="voucherCodeInput"placeholder="Contoh: GR4N_0PEN_KN1VERSE" required oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9_\-]/g, '')">
            </div>

            <div class="form-group">
              <label>Tipe Voucher *</label>
              <select id="voucherTypeInput" required>
                <option value="fixed">Diskon Tetap (Rp)</option>
                <option value="percent">Diskon Persen (%)</option>
                <option value="freeShipping">Gratis Ongkir</option>
              </select>
            </div>

            <div class="form-group">
              <label>Nilai Diskon *</label>
              <input
                type="number"
                id="voucherValueInput"
                placeholder="5000 (fixed) / 10 (percent)"
                min="0"
                required
              >
            </div>

            <div class="form-group">
              <label>Minimum Pembelian (Rp)</label>
              <input
                type="number"
                id="voucherMinInput"
                placeholder="0"
                min="0"
                value="0"
              >
            </div>

            <div class="form-group">
              <label>Batas Waktu Voucher</label>
              <input type="datetime-local" id="voucherExpiryInput">
            </div>

            <div class="form-group">
              <label>Deskripsi</label>
              <input
                type="text"
                id="voucherDescInput"
                placeholder="Keterangan singkat"
              >
            </div>

            <button type="submit" class="btn btn-primary">
              Tambah Voucher
            </button>
          </form>
        </div>

        <!-- ===== List Voucher Aktif ===== -->
        <div class="list-col">
          <div class="voucher-header">
            <h4 style="margin: 0; color: var(--dark);">Voucher Aktif</h4>
          </div>

        <div id="adminVoucherList">
          <!-- Vouchers will be loaded here via JavaScript -->
        </div>

        </div>
      </div>
    </div>
  </div>

</main>
{{-- =================== Edit Voucher Modal ================= --> --}}
<div id="editVoucher" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Edit Voucher</h2>
      <button class="close-modal" onclick="closeEditVoucher()">&times;</button>
    </div>

    <form id="editVoucherForm">
      <div class="form-group">
        <label>Kode Voucher</label>
        <input type="text" name="code" id="editCode" required>
      </div>

      <div class="form-group">
        <label>Tipe</label>
        <select name="type" id="editType">
          <option value="fixed">Fixed</option>
          <option value="percent">Percent</option>
          <option value="freeShipping">Gratis Ongkir</option>
        </select>
      </div>

      <div class="form-group">
        <label>Nilai</label>
        <input type="number" name="value" id="editValue" required>
      </div>

      <div class="form-group">
        <label>Minimal Pembelian</label>
        <input type="number" name="min_purchase" id="editMin">
      </div>

      <div class="form-group">
        <label>Tanggal Kadaluarsa</label>
        <input type="datetime-local" name="expired_at" id="editExpired">
      </div>

      <div class="form-group">
        <label>Deskripsi</label>
        <input type="text" name="description" id="editDesc">
      </div>

      <button type="submit" class="btn btn-primary">Simpan</button>
      {{-- <button type="button" onclick="closeEditVoucher()">Batal</button> --}}
    </form>
  </div>
</div>

<!-- ================= Edit Product Modal ================= -->
  <div id="editModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Edit Produk</h2>
        <button class="close-modal" onclick="closeEditModal()">&times;</button>
      </div>

      <form id="editProductForm">
        <input type="hidden" id="editProductIndex">

        <div class="form-group">
          <label>Nama Produk</label>
          <input type="text" id="editProductName" required>
        </div>

        <div class="form-group">
          <label>Deskripsi</label>
          <textarea id="editProductDesc" required></textarea>
        </div>

        <div class="form-group">
          <label>Harga (Rp)</label>
          <input type="number" id="editProductPrice" required min="0">
        </div>

        <div class="form-group">
          <label>Upload Gambar</label>
          <input
            type="file"
            id="editProductImageFile"
            accept="image/*"
            onchange="previewEditImageUpload()"
          >

          <div class="image-preview" id="editImagePreview">
            <div class="image-preview-text">
              Preview gambar akan muncul di sini
            </div>
          </div>

          <input type="hidden" id="editProductImage" required>
        </div>

        <div class="form-group">
          <label>ID Produk</label>
          <input type="text" id="editProductId" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Produk</button>
      </form>
    </div>
  </div>

{{-- 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
   
    // Orders functions
    async function getOrders() {
      try {
        const response = await fetch('/admin', {
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });
        if (response.ok) {
          const data = await response.json();
          return data;
        } else {
          console.error('Failed to fetch orders');
          return [];
        }
      } catch (e) {
        console.error('Error fetching orders:', e);
        return [];
      }
    }

    // Format currency
    function formatRupiah(amount) {
      return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Show alert
    function showAlert(message, type = 'success') {
      const alert = document.getElementById('alert');
      alert.className = `alert alert-${type} show`;
      alert.textContent = message;
      
      setTimeout(() => {
        alert.classList.remove('show');
      }, 3000);
    }

    // Switch tabs
    function switchTab(tabName) {
      document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
      });

      document.querySelectorAll('.menu-item').forEach(item => {
        item.classList.remove('active');
      });

      const tabMap = {
        'dashboard': 'dashboardTab',
        'products': 'productsTab',
        'orders': 'ordersTab',
        'addproduct': 'addproductTab',
        'vouchers': 'vouchersTab'
      };

      const titleMap = {
        'dashboard': 'Dashboard',
        'products': 'Kelola Produk',
        'orders': 'Kelola Pesanan',
        'addproduct': 'Tambah Produk',
        'vouchers': 'Kelola Voucher'
      };

      document.getElementById(tabMap[tabName]).classList.add('active');
      document.getElementById('pageTitle').textContent = titleMap[tabName];
      const activeMenu = document.querySelector(`.menu-item[data-tab="${tabName}"]`);
     if (activeMenu) {
        activeMenu.classList.add('active');
      }

      // load data
      if (tabName === 'products') loadProducts();
      if (tabName === 'dashboard') updateDashboard();
    }

    // Load products
    async function loadProducts() {
      try {
        const response = await fetch('/admin/products', {
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });

        if (response.ok) {
          const products = await response.json();
          const container = document.getElementById('productList');

          if (products.length === 0) {
            container.innerHTML = '<p style="color: #666; grid-column: 1/-1; text-align: center;">Belum ada produk. Silakan tambah produk baru.</p>';
            return;
          }

          container.innerHTML = products.map((product) => `
            <div class="product-card">
              <img src="/${product.gambar}" alt="${product.nama_produk}" onerror="this.src='https://via.placeholder.com/300x180?text=No+Image'">
              <div class="product-info">
                <h4>${product.nama_produk}</h4>
                <p>${product.deskripsi}</p>
                <div class="product-price">${formatRupiah(product.harga)}</div>
                <div class="product-actions">
                  <button class="btn btn-edit" onclick="openEditModal(${product.id})">Edit</button>
                  <button class="btn btn-delete" onclick="confirmDelete(${product.id})">Hapus</button>
                </div>
              </div>
            </div>
          `).join('');
        } else {
          console.error('Failed to load products');
          const container = document.getElementById('productList');
          container.innerHTML = '<p style="color: #666; grid-column: 1/-1; text-align: center;">Gagal memuat produk.</p>';
        }
      } catch (error) {
        console.error('Error loading products:', error);
        const container = document.getElementById('productList');
        container.innerHTML = '<p style="color: #666; grid-column: 1/-1; text-align: center;">Terjadi kesalahan saat memuat produk.</p>';
      }
    }

    // Load orders
    function loadOrders() {
      const orders = getOrders();
      const tbody = document.getElementById('ordersList');
      document.getElementById('selectAllCheckbox').checked = false;
      document.getElementById('bulkActionsContainer').style.display = 'none';

      if (orders.length === 0) {
        tbody.innerHTML = '<tr><td colspan="8" style="text-align: center; color: #666;">Belum ada pesanan</td></tr>';
        return;
      }

      // tbody.innerHTML = orders.slice().reverse().map((order, index) => {
      //   const originalIndex = orders.length - 1 - index;
      //   return `
      //     // <tr class="order-row" data-index="${originalIndex}">
      //     //   <td><input type="checkbox" class="order-checkbox order-item-checkbox" data-index="${originalIndex}" onchange="updateBulkActionsUI()"></td>
      //     //   <td>${order.nama}</td>
      //     //   <td>${order.item}</td>
      //     //   <td style="font-size: 0.85rem;">${order.alamat}</td>
      //     //   <td style="font-weight: 600;">${formatRupiah(order.total)}</td>
      //     //   <td style="font-size: 0.85rem;">${order.tanggal}</td>
      //     //   <td style="font-size: 0.85rem;">${order.metodeKirim || '-'}</td>
      //     //   <td style="font-size: 0.85rem;">${order.metodeBayar || '-'}</td>
      //     // </tr>
      //   `;
      // }).join('');
    }

    // Add product form submit
    document.getElementById('addProductForm').addEventListener('submit', async function(e) {
      e.preventDefault();

      const product = {
        nama_produk: document.getElementById('productName').value.trim(),
        deskripsi: document.getElementById('productDesc').value.trim(),
        harga: parseInt(document.getElementById('productPrice').value),
        gambar: document.getElementById('productImage').value.trim(),
        kategori: document.getElementById('productCategory') ? document.getElementById('productCategory').value : 'utama'
      };

      if (!product.nama_produk || !product.deskripsi || !product.harga || !product.gambar) {
        showAlert('Semua field harus diisi!', 'error');
        return;
      }

      try {
        const response = await fetch('/admin/products', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
          },
          body: JSON.stringify(product)
        });

        const data = await response.json();

        if (data.success) {
          showAlert('✅ Produk berhasil ditambahkan!');
          this.reset();
          document.getElementById('imagePreview').innerHTML = '<div class="image-preview-text">Preview gambar akan muncul di sini</div>';

          setTimeout(() => {
            document.querySelector('.menu-item:nth-child(2)').click();
          }, 1000);
        } else {
          showAlert('Gagal menambahkan produk!', 'error');
        }
      } catch (error) {
        console.error('Error:', error);
        showAlert('Terjadi kesalahan saat menambahkan produk!', 'error');
      }
    });

     // Update bundle form when category changes
    function updateBundleForm() {
      const category = document.getElementById('productCategory').value;
      const bundleFormSection = document.getElementById('bundleFormSection');
      
      if (category === 'secret') {
        bundleFormSection.style.display = 'block';
        // Jika belum ada item, tambahkan satu slot default
        if (!bundleItems || bundleItems.length === 0) {
          addBundleItemSlot();
        } else {
          renderBundleItems();
        }
      } else {
        bundleFormSection.style.display = 'none';
        cancelBundleForm();
      }
    }

    // Show/hide the includes input when category changes
    function updateIncludesInputVisibility() {
      const categoryEl = document.getElementById('productCategory');
      if (!categoryEl) return;
      // For secret category, bundle form section akan ditampilkan otomatis via updateBundleForm
      // Also show the outer wrapper that contains the bundle form
      const wrapper = document.getElementById('bundleCountInfo');
      if (wrapper) {
        if (categoryEl.value === 'secret') wrapper.style.display = 'block';
        else wrapper.style.display = 'none';
      }
      // Toggle normal product fields and outer buttons
      const normal = document.getElementById('normalProductFields');
      const saveBtn = document.getElementById('saveProductBtn');
      const resetBtn = document.getElementById('resetProductBtn');
      if (categoryEl.value === 'secret') {
        if (normal) normal.style.display = 'none';
        if (saveBtn) saveBtn.style.display = 'none';
        if (resetBtn) resetBtn.style.display = 'none';
      } else {
        if (normal) normal.style.display = 'block';
        if (saveBtn) saveBtn.style.display = 'inline-block';
        if (resetBtn) resetBtn.style.display = 'inline-block';
      }
      updateBundleForm();
    }

    // Edit product
    async function openEditModal(id) {
      try {
        const response = await fetch(`/admin/products/${id}`, {
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });

        if (response.ok) {
          const product = await response.json();

          document.getElementById('editProductIndex').value = id;
          document.getElementById('editProductName').value = product.nama_produk;
          document.getElementById('editProductDesc').value = product.deskripsi;
          document.getElementById('editProductPrice').value = product.harga;
          document.getElementById('editProductImage').value = product.gambar;
          document.getElementById('editProductId').value = product.id;
          document.getElementById('editProductImageFile').value = '';

          // Display current image in preview
          const editPreview = document.getElementById('editImagePreview');
          if (product.gambar) {
            editPreview.innerHTML = `<img src="${product.gambar}" alt="Preview">`;
          } else {
            editPreview.innerHTML = '<div class="image-preview-text">Preview gambar akan muncul di sini</div>';
          }

          document.getElementById('editModal').classList.add('active');
        } else {
          showAlert('Gagal memuat data produk!', 'error');
        }
      } catch (error) {
        console.error('Error loading product for edit:', error);
        showAlert('Terjadi kesalahan saat memuat produk!', 'error');
      }
    }

    function closeEditModal() {
      document.getElementById('editModal').classList.remove('active');
    }

    function openEditVoucher(voucher) {
      console.log('Opening edit voucher modal for:', voucher);
      document.getElementById('editCode').value = voucher.code;
      document.getElementById('editType').value = voucher.type;
      document.getElementById('editValue').value = voucher.value;
      document.getElementById('editMin').value = voucher.min_purchase || 0;
      document.getElementById('editDesc').value = voucher.description || '';
      document.getElementById('editExpired').value = voucher.expired_at ? new Date(voucher.expired_at).toISOString().slice(0, 16) : '';
      
      const form = document.getElementById('editVoucherForm');
      form.action = `/admin/voucher/${voucher.id}`;
      
      document.getElementById('editVoucher').classList.add('active');
    }

    function closeEditVoucher() {
      document.getElementById('editVoucher').classList.remove('active');
    }

    document.getElementById('editVoucherForm').addEventListener('submit', async function(e) {
      e.preventDefault();

      const formData = new FormData(this);
      const data = Object.fromEntries(formData);

      // Convert empty string to null for expired_at
      if (data.expired_at === '') {
        data.expired_at = null;
      }

      try {
        const response = await fetch(this.action, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: JSON.stringify(data)
        });

        if (response.ok) {
          showAlert('✅ Voucher berhasil diperbarui');
          closeEditVoucher();
          renderAdminVouchers();
        } else {
          const errorData = await response.json();
          showAlert('❌ Gagal memperbarui voucher: ' + (errorData.message || 'Unknown error'), 'error');
        }
      } catch (error) {
        console.error('Error updating voucher:', error);
        showAlert('Terjadi kesalahan saat memperbarui voucher', 'error');
      }
    });

    document.getElementById('editProductForm').addEventListener('submit', async function(e) {
      e.preventDefault();

      const id = document.getElementById('editProductIndex').value;
      const product = {
        nama_produk: document.getElementById('editProductName').value.trim(),
        deskripsi: document.getElementById('editProductDesc').value.trim(),
        harga: parseInt(document.getElementById('editProductPrice').value),
        gambar: document.getElementById('editProductImage').value.trim()
      };

      if (!product.nama_produk || !product.deskripsi || !product.harga || !product.gambar) {
        showAlert('Semua field harus diisi!', 'error');
        return;
      }

      try {
        const response = await fetch(`/admin/products/${id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
          },
          body: JSON.stringify(product)
        });

        const data = await response.json();

        if (data.success) {
          showAlert('✅ Produk berhasil diperbarui!');
          closeEditModal();
          loadProducts();
        } else {
          showAlert('Gagal memperbarui produk!', 'error');
        }
      } catch (error) {
        console.error('Error updating product:', error);
        showAlert('Terjadi kesalahan saat memperbarui produk!', 'error');
      }
    });

    async function confirmDelete(id) {
      if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
        try {
          const response = await fetch(`/admin/products/${id}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
              'Content-Type': 'application/json',
            },
          });

          const data = await response.json();

          if (data.success) {
            showAlert('✅ Produk berhasil dihapus!');
            loadProducts();
          } else {
            showAlert('Gagal menghapus produk!', 'error');
          }
        } catch (error) {
          console.error('Error deleting product:', error);
          showAlert('Terjadi kesalahan saat menghapus produk!', 'error');
        }
      }
    }

    function previewImageUpload() {
      const fileInput = document.getElementById('productImageFile');
      const preview = document.getElementById('imagePreview');
      const hiddenInput = document.getElementById('productImage');

      if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
          preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
          hiddenInput.value = e.target.result;
        };

        reader.onerror = function() {
          preview.innerHTML = '<div class="image-preview-text">Gagal membaca file gambar</div>';
        };

        reader.readAsDataURL(fileInput.files[0]);
      } else {
        preview.innerHTML = '<div class="image-preview-text">Preview gambar akan muncul di sini</div>';
        hiddenInput.value = '';
      }
    }

    function resetForm() {
      document.getElementById('addProductForm').reset();
      document.getElementById('imagePreview').innerHTML = '<div class="image-preview-text">Preview gambar akan muncul di sini</div>';
      document.getElementById('productImage').value = '';
    }

    function previewEditImageUpload() {
      const fileInput = document.getElementById('editProductImageFile');
      const preview = document.getElementById('editImagePreview');
      const hiddenInput = document.getElementById('editProductImage');

      if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
          preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
          hiddenInput.value = e.target.result;
        };

        reader.onerror = function() {
          preview.innerHTML = '<div class="image-preview-text">Gagal membaca file gambar</div>';
        };

        reader.readAsDataURL(fileInput.files[0]);
      }
    }

    async function updateDashboard() {
      try {
        // Fetch products from database
        const productsResponse = await fetch('/admin/products', {
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });
        const products = productsResponse.ok ? await productsResponse.json() : [];

        // Fetch orders from database
        const orders = await getOrders();

        document.getElementById('totalProducts').textContent = products.length;
        document.getElementById('totalOrders').textContent = orders.length;

        const today = new Date().toISOString().split('T')[0]; // Format: YYYY-MM-DD
        const todayOrders = orders.filter(o => o.created_at && o.created_at.startsWith(today)).length;
        document.getElementById('todayOrders').textContent = todayOrders;

        const totalRevenue = orders.reduce((sum, o) => sum + (o.total || 0), 0);
        document.getElementById('totalRevenue').textContent = formatRupiah(totalRevenue);

        const recentDiv = document.getElementById('recentActivity');
        if (orders.length > 0) {
          const recentOrders = orders.slice(-5).reverse();
          recentDiv.innerHTML = recentOrders.map(order => {
            const date = new Date(order.created_at).toLocaleDateString('id-ID');
            return `
              <div style="padding: 10px; background: #fffbf5; border-radius: 8px; margin-bottom: 8px;">
                <div style="font-weight: 600; color: var(--dark);">${order.nama || 'N/A'} - ${formatRupiah(order.total || 0)}</div>
                <div style="font-size: 0.85rem; color: #666;">${date}</div>
              </div>
            `;
          }).join('');
        } else {
          recentDiv.innerHTML = '<p style="color: #666;">Belum ada aktivitas</p>';
        }
      } catch (error) {
        console.error('Error updating dashboard:', error);
        document.getElementById('recentActivity').innerHTML = '<p style="color: #666;">Gagal memuat aktivitas</p>';
      }
    }

    function deleteOrder(id) {
      if (confirm('Apakah Anda yakin ingin menghapus pesanan ini?')) {
        fetch(`/admin/orders/${id}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            'Content-Type': 'application/json',
          },
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            showAlert('✅ Pesanan berhasil dihapus!');
            // Refresh the orders table instead of reloading the page
            refreshOrdersTable();
          } else {
            showAlert('Gagal menghapus pesanan!', 'error');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          showAlert('Terjadi kesalahan saat menghapus pesanan!', 'error');
        });
      }
    }

    // Function to refresh orders table after deletion
    function refreshOrdersTable() {
      fetch('/admin')
        .then(response => response.text())
        .then(html => {
          // Extract the orders table body from the HTML response
          const parser = new DOMParser();
          const doc = parser.parseFromString(html, 'text/html');
          const newTableBody = doc.getElementById('ordersTableBody');

          if (newTableBody) {
            // Replace the current table body with the updated one
            const currentTableBody = document.getElementById('ordersTableBody');
            currentTableBody.innerHTML = newTableBody.innerHTML;
          }
        })
        .catch(error => {
          console.error('Error refreshing orders table:', error);
          // Fallback: reload the page
          location.reload();
        });
    }

   document.getElementById('addVoucherForm').addEventListener('submit', async function(e) {e.preventDefault();

    const data = {
      code: voucherCodeInput.value,
      type: voucherTypeInput.value,
      value: voucherValueInput.value,
      min_purchase: voucherMinInput.value,
      expired_at: voucherExpiryInput.value,
      description: voucherDescInput.value
    };

    const res = await fetch('/admin/voucher', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify(data)
    });

    if (res.ok) {
      showAlert('✅ Voucher ditambahkan');
      this.reset();
      renderAdminVouchers();
    } else {
      showAlert('❌ Gagal menambahkan voucher', 'error');
    }
  });



    async function toggleVoucher(id) {await fetch(`/admin/voucher/${id}/toggle`, {method: 'PATCH',headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    });
      renderAdminVouchers();
    }

   async function renderAdminVouchers() {const list = document.getElementById('adminVoucherList');

      try {
        const response = await fetch('/admin/voucher', {
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });

        const vouchers = await response.json();

        if (!vouchers.length) {
          list.innerHTML = '<p style="color:#666;">Belum ada voucher</p>';
          return;
        }

        list.innerHTML = vouchers.map(v => {
          const now = new Date();
          const expired = v.expired_at
            ? new Date(v.expired_at) < now
            : false;
          const exp = v.expired_at
            ? new Date(v.expired_at).toLocaleString('id-ID')
            : '-';

          const min = 'Rp ' + (v.min_purchase ?? 0).toLocaleString('id-ID');

          let valueText = '';
          if (v.type === 'percent') valueText = v.value + '%';
          else if (v.type === 'freeShipping') valueText = 'Gratis Ongkir';
          else valueText = 'Rp ' + v.value.toLocaleString('id-ID');

          return `
             
            <div class="voucher-card" ${new Date(v.expired_at) < new Date() ? 'expired' : ''}">
               ${expired ? `
                <div class="voucher-warning" title="Voucher sudah kedaluwarsa">
                  ⚠️
                </div>
              ` : ''}
              <div>
                <div class="voucher-code">${v.code}</div>
                <div class="voucher-desc">${v.description || ''}</div>
                <div class="voucher-meta">
                  ${valueText} • Min: ${min} • Exp: ${exp}
                </div>
              </div>
              <div class="voucher-actions">
                <button class="btn btn-delete" onclick="deleteVoucher(${v.id})">Hapus</button>
                <button class="btn btn-edit" onclick="openEditVoucher({
                  id: ${v.id},
                  code: '${v.code}',
                  type: '${v.type}',
                  value: ${v.value},
                  min_purchase: ${v.min_purchase ?? 0},
                  description: '${v.description || ''}',
                  expired_at: '${v.expired_at || ''}'
                })">Edit</button>
              </div>
            </div>
          `;
        }).join('');

      } catch (e) {
        list.innerHTML = '<p style="color:red;">Gagal memuat voucher</p>';
      }
    }

    // Add / Edit voucher form handler
    document.getElementById('addVoucherForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const code = document.getElementById('voucherCodeInput').value.trim().toUpperCase();
      const type = document.getElementById('voucherTypeInput').value;
      const value = parseInt(document.getElementById('voucherValueInput').value) || 0;
      const minPurchase = parseInt(document.getElementById('voucherMinInput').value) || 0;
      const expiry = document.getElementById('voucherExpiryInput').value ? new Date(document.getElementById('voucherExpiryInput').value).toISOString() : null;
      const desc = document.getElementById('voucherDescInput').value.trim();

      if (!code) {
        showAlert('Kode voucher wajib diisi', 'error');
        return;
      }

      const vouchers = getVouchers();

      // Check if editing
      const editingIndex = this.dataset.editing ? parseInt(this.dataset.editing) : -1;

      if (editingIndex >= 0) {
        // update
        vouchers[editingIndex] = {
          code, type, discount: value, minPurchase, expiry, description: desc
        };
        saveVouchers(vouchers);
        showAlert('✅ Voucher berhasil diperbarui!');
        this.reset();
        delete this.dataset.editing;
      } else {
        // new - ensure unique code
        if (vouchers.some(v => v.code === code)) {
          showAlert('Kode voucher sudah ada', 'error');
          return;
        }
        vouchers.push({ code, type, discount: value, minPurchase, expiry, description: desc });
        saveVouchers(vouchers);
        showAlert('✅ Voucher berhasil ditambahkan!');
        this.reset();
      }

      renderAdminVouchers();
    });

    function removeVoucherAdmin(index) {
      if (!confirm('Hapus voucher ini?')) return;
      const vouchers = getVouchers();
      vouchers.splice(index, 1);
      saveVouchers(vouchers);
      renderAdminVouchers();
      showAlert('✅ Voucher dihapus');
    }

    async function deleteVoucher(id) {
  if (!confirm('Hapus voucher?')) return;

  await fetch(`/admin/voucher/${id}`, {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    }
  });

  renderAdminVouchers();
}


    // Initialize
    loadProducts();
    updateDashboard();
    renderAdminVouchers();
</script>
</body>
</html>
