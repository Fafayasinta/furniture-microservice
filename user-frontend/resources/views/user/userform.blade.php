<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Order Furniture</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white dark:bg-gray-900">
<section class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
  <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Form Pemesanan Furniture</h2>

  @if (session('success'))
    <div class="p-3 bg-green-100 text-green-700 rounded mb-3">{{ session('success') }}</div>
  @endif

  @if (session('error'))
    <div class="p-3 bg-red-100 text-red-700 rounded mb-3">{{ session('error') }}</div>
  @endif

<form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

          <div class="sm:col-span-2">
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pemesan</label>
              <input type="text" name="nama_pemesan" class="w-full p-2.5 rounded-lg border text-sm" required>
          </div>

          <div class="sm:col-span-2">
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
              <textarea name="alamat" class="w-full p-2.5 rounded-lg border text-sm" required></textarea>
          </div>

          <div class="sm:col-span-2">
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Produk</label>
              <select name="product_id" class="w-full p-2.5 rounded-lg border text-sm" required>
                  <option selected disabled>-- Pilih Produk --</option>
                  @foreach ($products as $product)
                    <option value="{{ $product['id'] }}">
                      {{ $product['nama'] }} - Rp{{ number_format($product['harga']) }}
                    </option>
                  @endforeach
              </select>
          </div>

          <div>
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
              <input type="number" name="jumlah" class="w-full p-2.5 rounded-lg border text-sm" min="1" required>
          </div>

          <div class="sm:col-span-2">
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bukti Transfer</label>
              <input type="file" name="bukti_transfer" class="w-full p-2.5 rounded-lg border text-sm" required>
          </div>
      </div>

      <button type="submit"
          class="inline-flex items-center mt-6 px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
          Kirim Pesanan
      </button>
  </form>
</section>
</body>
</html>
