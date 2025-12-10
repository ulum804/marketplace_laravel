  // LocalStorage keys - SHARED WITH MENU & ORDER
    const PRODUCTS_KEY = 'kniverse_admin_products';
    const ORDERS_KEY = 'kniverse_admin_orders';

    // Initialize with sample data if empty
    function initSampleData() {
      const existing = getProducts();
      if (existing.length === 0) {
        const sampleProducts = [
          {id:'dimsum', name:'Dimsum Chili Oil', price:15000, desc:'Dimsum isi ayam udang lembut dengan chili oil khas KNiverse.', image:'asset/dimsumhome.jpg'},
          {id:'wonton', name:'Wonton Chili Oil', price:12000, desc:'Wonton lembut dengan isian daging ayam dicampur dengan udang disiram chili oil pedas gurih.', image:'asset/wontonmenu.jpeg'},
          {id:'corndog', name:'Corndog Sosis Crispy', price:10000, desc:'Corndog sosis crispy luar dalam, gurihnya nagih!', image:'asset/corndoghome.jpg'},
          {id:'risol', name:'Risol Mayo', price:14000, desc:'Risol mayo isi ayam lembut dengan saus gurih.', image:'asset/gallery2.png'},
          {id:'siomay', name:'Siomay Chili Oil', price:13000, desc:'Siomay udang segar lembut dan gurih.', image:'asset/gallery2.png'},
          {id:'enoki', name:'Jamur Enoki Crispy', price:8000, desc:'Berisi jamur enoki yang gurih dan renyah dibalut dengan saus sambal atau tomat.', image:'asset/gallery2.png'},
          {id:'tahu', name:'Tahu Bakso', price:5000, desc:'Tahu isi bakso ayam gurih berisi 2 tahu bakso yang cocok buat teman makan siang.', image:'asset/gallery2.png'},
          {id:'brownies', name:'Brownies Jumnawa', price:10000, desc:'Memiliki beberapa rasa favorit sepanjang masa, terdiri dari rasa original, strawberry, melon, oreo, milo.', image:'asset/gallery2.png'}
        ];
        saveProducts(sampleProducts);
      }
    }

    // Products CRUD
    function getProducts() {
      try {
        const data = localStorage.getItem(PRODUCTS_KEY);
        return data ? JSON.parse(data) : [];
      } catch (e) {
        return [];
      }
    }

    function saveProducts(products) {
      try {
        localStorage.setItem(PRODUCTS_KEY, JSON.stringify(products));
      } catch (e) {
        console.error('Error saving products:', e);
      }
    }

    function addProduct(product) {
      const products = getProducts();
      products.push(product);
      saveProducts(products);
    }

    function updateProduct(index, product) {
      const products = getProducts();
      products[index] = product;
      saveProducts(products);
    }

    function deleteProduct(index) {
      const products = getProducts();
      products.splice(index, 1);
      saveProducts(products);
    }

    // Orders functions
    async function getOrders() {
      try {
        const response = await fetch('/admin/orders');
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
    function loadProducts() {
      const products = getProducts();
      const container = document.getElementById('productList');

      if (products.length === 0) {
        container.innerHTML = '<p style="color: #666; grid-column: 1/-1; text-align: center;">Belum ada produk. Silakan tambah produk baru.</p>';
        return;
      }

      container.innerHTML = products.map((product, index) => `
        <div class="product-card">
          <img src="${product.image}" alt="${product.name}" onerror="this.src='https://via.placeholder.com/300x180?text=No+Image'">
          <div class="product-info">
            <h4>${product.name}</h4>
            <p>${product.desc}</p>
            <div class="product-price">${formatRupiah(product.price)}</div>
            <div class="product-actions">
              <button class="btn btn-edit" onclick="openEditModal(${index})">Edit</button>
              <button class="btn btn-delete" onclick="confirmDelete(${index})">Hapus</button>
            </div>
          </div>
        </div>
      `).join('');
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

      tbody.innerHTML = orders.slice().reverse().map((order, index) => {
        const originalIndex = orders.length - 1 - index;
        return `
          <tr class="order-row" data-index="${originalIndex}">
            <td><input type="checkbox" class="order-checkbox order-item-checkbox" data-index="${originalIndex}" onchange="updateBulkActionsUI()"></td>
            <td>${order.nama}</td>
            <td>${order.item}</td>
            <td style="font-size: 0.85rem;">${order.alamat}</td>
            <td style="font-weight: 600;">${formatRupiah(order.total)}</td>
            <td style="font-size: 0.85rem;">${order.tanggal}</td>
            <td style="font-size: 0.85rem;">${order.metodeKirim || '-'}</td>
            <td style="font-size: 0.85rem;">${order.metodeBayar || '-'}</td>
          </tr>
        `;
      }).join('');
    }

    // Add product form submit
    document.getElementById('addProductForm').addEventListener('submit', function(e) {
      e.preventDefault();

      const product = {
        id: document.getElementById('productId').value.trim(),
        name: document.getElementById('productName').value.trim(),
        desc: document.getElementById('productDesc').value.trim(),
        price: parseInt(document.getElementById('productPrice').value),
        image: document.getElementById('productImage').value.trim()
      };

      if (!product.id || !product.name || !product.desc || !product.price || !product.image) {
        showAlert('Semua field harus diisi!', 'error');
        return;
      }

      const products = getProducts();
      if (products.some(p => p.id === product.id)) {
        showAlert('ID produk sudah digunakan!', 'error');
        return;
      }

      addProduct(product);
      showAlert('✅ Produk berhasil ditambahkan!');
      this.reset();
      document.getElementById('imagePreview').innerHTML = '<div class="image-preview-text">Preview gambar akan muncul di sini</div>';
      
      setTimeout(() => {
        document.querySelector('.menu-item:nth-child(2)').click();
      }, 1000);
    });

    // Edit product
    function openEditModal(index) {
      const products = getProducts();
      const product = products[index];

      document.getElementById('editProductIndex').value = index;
      document.getElementById('editProductName').value = product.name;
      document.getElementById('editProductDesc').value = product.desc;
      document.getElementById('editProductPrice').value = product.price;
      document.getElementById('editProductImage').value = product.image;
      document.getElementById('editProductId').value = product.id;
      document.getElementById('editProductImageFile').value = '';

      // Display current image in preview
      const editPreview = document.getElementById('editImagePreview');
      if (product.image) {
        editPreview.innerHTML = `<img src="${product.image}" alt="Preview">`;
      } else {
        editPreview.innerHTML = '<div class="image-preview-text">Preview gambar akan muncul di sini</div>';
      }

      document.getElementById('editModal').classList.add('active');
    }

    function closeEditModal() {
      document.getElementById('editModal').classList.remove('active');
    }

    document.getElementById('editProductForm').addEventListener('submit', function(e) {
      e.preventDefault();

      const index = parseInt(document.getElementById('editProductIndex').value);
      const product = {
        id: document.getElementById('editProductId').value.trim(),
        name: document.getElementById('editProductName').value.trim(),
        desc: document.getElementById('editProductDesc').value.trim(),
        price: parseInt(document.getElementById('editProductPrice').value),
        image: document.getElementById('editProductImage').value.trim()
      };

      updateProduct(index, product);
      showAlert('✅ Produk berhasil diperbarui!');
      closeEditModal();
      loadProducts();
    });

    function confirmDelete(index) {
      if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
        deleteProduct(index);
        showAlert('✅ Produk berhasil dihapus!');
        loadProducts();
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

    function updateDashboard() {
      const products = getProducts();
      const orders = getOrders();

      document.getElementById('totalProducts').textContent = products.length;
      document.getElementById('totalOrders').textContent = orders.length;

      const today = new Date().toLocaleDateString('id-ID');
      const todayOrders = orders.filter(o => o.tanggal === today).length;
      document.getElementById('todayOrders').textContent = todayOrders;

      const totalRevenue = orders.reduce((sum, o) => sum + (o.total || 0), 0);
      document.getElementById('totalRevenue').textContent = formatRupiah(totalRevenue);

      const recentDiv = document.getElementById('recentActivity');
      if (orders.length > 0) {
        const recentOrders = orders.slice(-5).reverse();
        recentDiv.innerHTML = recentOrders.map(order => `
          <div style="padding: 10px; background: #fffbf5; border-radius: 8px; margin-bottom: 8px;">
            <div style="font-weight: 600; color: var(--dark);">${order.nama} - ${formatRupiah(order.total)}</div>
            <div style="font-size: 0.85rem; color: #666;">${order.tanggal}</div>
          </div>
        `).join('');
      } else {
        recentDiv.innerHTML = '<p style="color: #666;">Belum ada aktivitas</p>';
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
            // Reload the page to refresh the orders list
            location.reload();
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
    initSampleData();
    loadProducts();
    updateDashboard();