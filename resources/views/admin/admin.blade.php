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

    <div class="menu-item active" onclick="switchTab('dashboard')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="3" width="7" height="7"></rect>
        <rect x="14" y="3" width="7" height="7"></rect>
        <rect x="14" y="14" width="7" height="7"></rect>
        <rect x="3" y="14" width="7" height="7"></rect>
      </svg>
      Dashboard
    </div>

    <div class="menu-item" onclick="switchTab('products')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
        <line x1="3" y1="9" x2="21" y2="9"></line>
        <line x1="9" y1="21" x2="9" y2="9"></line>
      </svg>
      Produk
    </div>

    <div class="menu-item" onclick="switchTab('orders')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="9" cy="21" r="1"></circle>
        <circle cx="20" cy="21" r="1"></circle>
        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
      </svg>
      Pesanan
    </div>

    <div class="menu-item" onclick="switchTab('addproduct')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
      Tambah Produk
    </div>

    <div class="menu-item" onclick="window.location.href='{{ url('/market/home') }}'" style="margin-top: 20px; border-top: 1px solid var(--border); padding-top: 20px;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
        <polyline points="16 17 21 12 16 7"></polyline>
        <line x1="21" y1="12" x2="9" y2="12"></line>
      </svg>
      Ke Website
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
        <div class="user-avatar">A</div>
        <div>
          <div style="font-weight: 600;">Admin KNiverse</div>
          <div style="font-size: 0.85rem; color: #666;">Super Admin</div>
        </div>
      </div>
    </div>

    <!-- Dashboard Tab -->
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
          <div class="trend">↑ hari ini</div>
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

    <!-- Products Tab -->
    <div id="productsTab" class="tab-content">
      <div style="margin-bottom: 20px;">
        <button class="btn btn-primary" onclick="switchTab('addproduct')">+ Tambah Produk Baru</button>
      </div>

      <div class="product-grid" id="productList">
        <!-- Products will be loaded here -->
      </div>
    </div>

    <!-- Orders Tab -->
    <div id="ordersTab" class="tab-content">
      {{-- <div class="bulk-actions" id="bulkActionsContainer" style="display: none;">
        <span class="bulk-actions-info" id="selectedCountInfo">0 pesanan dipilih</span>
        <button type="button" class="btn btn-secondary" onclick="selectAllOrders()">Pilih Semua</button>
        <button type="button" class="btn btn-secondary" onclick="deselectAllOrders()">Batalkan Pilihan</button>
        <button type="button" class="btn btn-danger" id="deleteSelectedBtn" onclick="deleteSelectedOrders()" disabled>Hapus Pilihan</button>
      </div> --}}
      <div class="orders-table">
        <table>
          <thead>
            <tr>
              {{-- <th style="width: 30px;">
                <input type="checkbox" id="selectAllCheckbox" class="order-checkbox" onchange="toggleSelectAll(this)">
              </th> --}}
              <th>Nama</th>
              <th>produk</th>
              <th>Alamat</th>
              <th>catatan</th>
              <th>Total</th>
              <th>Aksi</th>
              {{-- <th>Tanggal</th>
              <th>Metode Kirim</th>
              <th>Bayar</th> --}}
            </tr>
          </thead>
          {{-- <tbody id="ordersList"> --}
          {{-- </tbody> --}}
          <tbody id="ordersTableBody">
            @foreach ($toko as $item )
              <tr data-id="{{ $item->id }}">
                {{-- <td><input type="" class="" data-index="{{ $loop->index }}" onchange="updateBulkActionsUI()"></td> --}}
                <td>{{ $item->nama }}</td>
                <td>{{ $item->produk }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->catatan }}</td>
                <td>{{ number_format($item->total, 0, ',', '.') }}</td>
                <td>
                  <button class="btn btn-delete" onclick="deleteOrder({{ $item->id }})">Hapus</button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- Add Product Tab -->
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
            <input type="number" id="productPrice" required placeholder="15000" min="0">
          </div>

          <div class="form-group">
            <label>Upload Gambar *</label>
            <input type="file" id="productImageFile" accept="image/*" required onchange="previewImageUpload()">
            <div class="image-preview" id="imagePreview">
              <div class="image-preview-text">Preview gambar akan muncul di sini</div>
            </div>
            <input type="hidden" id="productImage" required>
          </div>

          {{-- <div class="form-group">
            <label>ID Produk (otomatis) *</label>
            <input type="text" id="productId" required placeholder="dimsum-chili-oil" oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9-]/g, '')">
          </div> --}}

          <button type="submit" class="btn btn-primary">Simpan Produk</button>
          <button type="button" class="btn" style="background: var(--gray); margin-left: 10px;" onclick="resetForm()">Reset Form</button>
        </form>
      </div>
    </div>
  </main>

  <!-- Edit Product Modal -->
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
          <input type="file" id="editProductImageFile" accept="image/*" onchange="previewEditImageUpload()">
          <div class="image-preview" id="editImagePreview">
            <div class="image-preview-text">Preview gambar akan muncul di sini</div>
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
    // LocalStorage keys - SHARED WITH MENU & ORDER
    // const PRODUCTS_KEY = 'kniverse_admin_products';
    // const ORDERS_KEY = 'kniverse_admin_orders';

    // Initialize with sample data if empty
    // function initSampleData() {
    //   const existing = getProducts();
    //   if (existing.length === 0) {
    //     const sampleProducts = [
    //       {id:'dimsum', name:'Dimsum Chili Oil', price:15000, desc:'Dimsum isi ayam udang lembut dengan chili oil khas KNiverse.', image:'asset/dimsumhome.jpg'},
    //       {id:'wonton', name:'Wonton Chili Oil', price:12000, desc:'Wonton lembut dengan isian daging ayam dicampur dengan udang disiram chili oil pedas gurih.', image:'asset/wontonmenu.jpeg'},
    //       {id:'corndog', name:'Corndog Sosis Crispy', price:10000, desc:'Corndog sosis crispy luar dalam, gurihnya nagih!', image:'asset/corndoghome.jpg'},
    //       {id:'risol', name:'Risol Mayo', price:14000, desc:'Risol mayo isi ayam lembut dengan saus gurih.', image:'asset/gallery2.png'},
    //       {id:'siomay', name:'Siomay Chili Oil', price:13000, desc:'Siomay udang segar lembut dan gurih.', image:'asset/gallery2.png'},
    //       {id:'enoki', name:'Jamur Enoki Crispy', price:8000, desc:'Berisi jamur enoki yang gurih dan renyah dibalut dengan saus sambal atau tomat.', image:'asset/gallery2.png'},
    //       {id:'tahu', name:'Tahu Bakso', price:5000, desc:'Tahu isi bakso ayam gurih berisi 2 tahu bakso yang cocok buat teman makan siang.', image:'asset/gallery2.png'},
    //       {id:'brownies', name:'Brownies Jumnawa', price:10000, desc:'Memiliki beberapa rasa favorit sepanjang masa, terdiri dari rasa original, strawberry, melon, oreo, milo.', image:'asset/gallery2.png'}
    //     ];
    //     saveProducts(sampleProducts);
    //   }
    // }

    // Products CRUD
    // function getProducts() {
    //   try {
    //     const data = localStorage.getItem(PRODUCTS_KEY);
    //     return data ? JSON.parse(data) : [];
    //   } catch (e) {
    //     return [];
    //   }
    // }

    // function saveProducts(products) {
    //   try {
    //     localStorage.setItem(PRODUCTS_KEY, JSON.stringify(products));
    //   } catch (e) {
    //     console.error('Error saving products:', e);
    //   }
    // }

    // function addProduct(product) {
    //   const products = getProducts();
    //   products.push(product);
    //   saveProducts(products);
    // }

    // function updateProduct(index, product) {
    //   const products = getProducts();
    //   products[index] = product;
    //   saveProducts(products);
    // }

    // function deleteProduct(index) {
    //   const products = getProducts();
    //   products.splice(index, 1);
    //   saveProducts(products);
    // }

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
        'addproduct': 'addproductTab'
      };

      const titleMap = {
        'dashboard': 'Dashboard',
        'products': 'Kelola Produk',
        'orders': 'Kelola Pesanan',
        'addproduct': 'Tambah Produk'
      };

      document.getElementById(tabMap[tabName]).classList.add('active');
      document.getElementById('pageTitle').textContent = titleMap[tabName];

      if (event && event.target) {
        event.target.classList.add('active');
      }

      if (tabName === 'products') {
        loadProducts();
      } else if (tabName === 'dashboard') {
        updateDashboard();
      }
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
        gambar: document.getElementById('productImage').value.trim()
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

    // Bulk selection functions
    function toggleSelectAll(checkbox) {
      const checkboxes = document.querySelectorAll('.order-item-checkbox');
      checkboxes.forEach(cb => cb.checked = checkbox.checked);
      updateBulkActionsUI();
    }

    function selectAllOrders() {
      document.querySelectorAll('.order-item-checkbox').forEach(cb => cb.checked = true);
      document.getElementById('selectAllCheckbox').checked = true;
      updateBulkActionsUI();
    }

    function deselectAllOrders() {
      document.querySelectorAll('.order-item-checkbox').forEach(cb => cb.checked = false);
      document.getElementById('selectAllCheckbox').checked = false;
      updateBulkActionsUI();
    }

    function updateBulkActionsUI() {
      const selectedCheckboxes = document.querySelectorAll('.order-item-checkbox:checked');
      const bulkContainer = document.getElementById('bulkActionsContainer');
      const deleteBtn = document.getElementById('deleteSelectedBtn');
      const countInfo = document.getElementById('selectedCountInfo');

      if (selectedCheckboxes.length > 0) {
        bulkContainer.style.display = 'flex';
        deleteBtn.disabled = false;
        countInfo.textContent = `${selectedCheckboxes.length} pesanan dipilih`;
      } else {
        bulkContainer.style.display = 'none';
        deleteBtn.disabled = true;
      }

      // Update select all checkbox state
      const allCheckboxes = document.querySelectorAll('.order-item-checkbox');
      const selectAllCheckbox = document.getElementById('selectAllCheckbox');
      if (allCheckboxes.length > 0) {
        selectAllCheckbox.checked = selectedCheckboxes.length === allCheckboxes.length && selectedCheckboxes.length > 0;
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

    function deleteSelectedOrders() {
      const selectedCheckboxes = document.querySelectorAll('.order-item-checkbox:checked');
      if (selectedCheckboxes.length === 0) {
        showAlert('Pilih pesanan yang ingin dihapus terlebih dahulu!', 'error');
        return;
      }

      if (confirm(`Apakah Anda yakin ingin menghapus ${selectedCheckboxes.length} pesanan terpilih?`)) {
        const orders = getOrders();
        const indicesToDelete = Array.from(selectedCheckboxes)
          .map(cb => parseInt(cb.getAttribute('data-index')))
          .sort((a, b) => b - a); // Sort descending to avoid index issues

        indicesToDelete.forEach(index => {
          orders.splice(index, 1);
        });

        try {
          localStorage.setItem(ORDERS_KEY, JSON.stringify(orders));
          showAlert(`✅ ${indicesToDelete.length} pesanan berhasil dihapus!`);
          loadOrders();
        } catch (e) {
          showAlert('Gagal menghapus pesanan!', 'error');
        }
      }
    }

    // Initialize
    loadProducts();
    updateDashboard();
</script>
</body>
</html>
