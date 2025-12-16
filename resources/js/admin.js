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
    // Vouchers management (admin)
    // const VOUCHERS_KEY = 'kniverse_vouchers';

    // function getVouchers() {
    //   try {
    //     const data = localStorage.getItem(VOUCHERS_KEY);
    //     return data ? JSON.parse(data) : [];
    //   } catch (e) {
    //     return [];
    //   }
    // }

    // function saveVouchers(vouchers) {
    //   try {
    //     localStorage.setItem(VOUCHERS_KEY, JSON.stringify(vouchers));
    //   } catch (e) {
    //     console.error('Error saving vouchers:', e);
    //   }
    // }

    async function renderAdminVouchers() {
      const list = document.getElementById('adminVoucherList');
      let vouchers = [];
      try {
        if (window.KNAPI && KNAPI.getVouchers) vouchers = await KNAPI.getVouchers();
        else vouchers = getVouchers();
      } catch (e) {
        console.error('Error loading vouchers:', e);
        vouchers = getVouchers();
      }
      if (!vouchers || vouchers.length === 0) {
        list.innerHTML = '<p style="color:#666;">Belum ada voucher. Tambahkan voucher baru.</p>';
        return;
      }

      list.innerHTML = vouchers.map((v, idx) => {
        const expText = v.expiry ? new Date(v.expiry).toLocaleString('id-ID') : '-';
        const minText = v.minPurchase ? 'Rp ' + v.minPurchase.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : 'Rp 0';
        const valueText = v.type === 'percent' ? v.discount + '%' : (v.type === 'freeShipping' ? 'Gratis Ongkir' : 'Rp ' + v.discount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
        return `
          <div class="voucher-card">
            <div class="voucher-info">
              <div class="voucher-code">${v.code}</div>
              <div class="voucher-desc">${v.description || ''}</div>
              <div class="voucher-meta">${valueText} • Min: ${minText} • Exp: ${expText}</div>
            </div>
            <div class="voucher-actions">
              <button class="btn-voucher-edit" onclick="editVoucher(${idx})">Edit</button>
              <button class="btn-voucher-delete" onclick="removeVoucherAdmin(${idx})">Hapus</button>
            </div>
          </div>
        `;
      }).join('');
    }

    // Add / Edit voucher form handler
   document.getElementById('addVoucherForm').addEventListener('submit', async function(e) {
  e.preventDefault();

  const form = this;
  const editId = form.dataset.editId;

  const data = {
    code: voucherCodeInput.value,
    type: voucherTypeInput.value,
    value: voucherValueInput.value,
    min_purchase: voucherMinInput.value,
    expired_at: voucherExpiryInput.value,
    description: voucherDescInput.value
  };

  const url = editId
    ? `/admin/voucher/${editId}`
    : `/admin/voucher`;

  const method = editId ? 'PUT' : 'POST';

  const res = await fetch(url, {
    method: method,
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify(data)
  });

  if (res.ok) {
    showAlert(editId ? '✅ Voucher diperbarui' : '✅ Voucher ditambahkan');
    form.reset();
    delete form.dataset.editId;
    renderAdminVouchers();
  } else {
    showAlert('❌ Gagal menyimpan voucher', 'error');
  }
});


    function removeVoucherAdmin(index) {
      if (!confirm('Hapus voucher ini?')) return;
      const vouchers = getVouchers();
      vouchers.splice(index, 1);
      saveVouchers(vouchers);
      renderAdminVouchers();
      showAlert('✅ Voucher dihapus');
    }

    async function editVoucher(id) {
      try {
        const res = await fetch(`/admin/voucher/${id}`, {
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });

        if (!res.ok) {
          showAlert('Gagal mengambil data voucher', 'error');
          return;
        }

        const v = await res.json();

        // isi form
        document.getElementById('voucherCodeInput').value = v.code;
        document.getElementById('voucherTypeInput').value = v.type;
        document.getElementById('voucherValueInput').value = v.value;
        document.getElementById('voucherMinInput').value = v.min_purchase ?? 0;
        document.getElementById('voucherDescInput').value = v.description ?? '';

        document.getElementById('voucherExpiryInput').value =
          v.expired_at ? v.expired_at.replace(' ', 'T').slice(0,16) : '';

        // tandai form sedang edit
        const form = document.getElementById('addVoucherForm');
        form.dataset.editId = v.id;

        showAlert('Mode edit aktif, klik "Tambah Voucher" untuk menyimpan perubahan', 'info');

      } catch (err) {
        console.error(err);
        showAlert('Terjadi kesalahan', 'error');
      }
    }


    // Initialize
    loadProducts();
    updateDashboard();
    renderAdminVouchers();