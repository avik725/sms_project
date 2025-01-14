<!doctype html>
<html lang="en">

<head>
  @include('Admin/common/header-link')
</head>

<body>
  <section id="dashboard-page">
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
      data-sidebar-position="fixed" data-header-position="fixed">

      @include('Admin/common/sidebar')
      <!--  Main wrapper -->
      <div class="body-wrapper">
        @include('Admin/common/header')
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-8 col-md-12 d-flex align-items-strech">
              <div class="card w-100">
                <div class="card-body">
                  <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                      <h5 class="card-title fw-semibold">Categories Overiew</h5>
                      <span class="fw-normal">Category wise Restock And Sales</span>
                    </div>
                  </div>
                  <div id="chart"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 selectize-cards">
              <div class="row">
                <div class="col-lg-12 col-md-6">
                  <div class="card stock-level">
                    <div class="card-body py-3 px-4">
                      <div class="row">
                        <div class="col-9">
                          <h5 class="card-title mb-3 fw-semibold">Stock Levels</h5>
                          <select name="item_id" id="item_id" class="form-control mb-3">
                            <option value="">Select Item</option>
                            @foreach ($items as $item)
                <option value="{{$item->items_id}}">{{$item->item}}</option>
              @endforeach
                          </select>
                          <h4 id="remaining-stock" class="fw-semibold mb-3 d-inline-block">0</h4>
                          <pre class="d-inline"><h5 id="unit_name" class="fw-semibold mv-3 d-inline-block"></h5></pre>

                          <div class="d-flex align-items-center">
                            <div class="me-4">
                              <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                              <span class="fs-2" id="category_name">Category | Subcategory</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-3 align-content-top">
                          <div class="d-flex justify-content-end">
                            <div
                              class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                              <i class="ti ti-brand-stackoverflow fs-6"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-6">
                  <div class="card category_items">
                    <div class="card-body py-3 px-4">
                      <div class="row align-items-start">
                        <div class="col-9">
                          <h5 class="card-title m-0 fw-semibold">No. Of Items</h5>
                          <span class="fw-normal">Category-wise</span>
                          <select name="category_id" id="category_id" class="form-control mt-3">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category_data)
                <option value="{{$category_data->category_id}}">{{$category_data->category}}</option>
              @endforeach
                          </select>
                          <h4 class="fw-semibold mb-3 mt-3" id="no_of_items">0</h4>
                          <div class="d-flex align-items-center">
                            <div class="me-4">
                              <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                              <span class="fs-2" id="subcategories_names">Subcategories</span>
                            </div>
                          </div>
                      </div>
                      <div class="col-3">
                        <div class="d-flex justify-content-end">
                          <div
                            class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                            <i class="ti ti-report-search fs-6"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="earning"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100 overflow-hidden">
              <div class="card-body p-4">
                <div class="mb-4">
                  <h5 class="card-title fw-semibold mb-lg-4">Product Expiry Alerts</h5>
                </div>
                <ul class="timeline-widget mb-0 position-relative mb-n5 pt-lg-2">
                  @foreach ($batches as $batch)
            <li class="timeline-item d-flex position-relative overflow-hidden mt-3">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-3">
              <div class="timeline-time text-dark flex-shrink-0 text-end ps-4">
                {{date('d M Y', strtotime($batch->expiry_date))}}
              </div>
              </div>
              <div class="col-lg-2 col-md-2 col-2">
              <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                <span class="timeline-badge border-2 border border-warning flex-shrink-0 my-8"></span>
                <span class="timeline-badge-border d-block flex-shrink-0"></span>
              </div>
              </div>
              <div class="col-lg-7 col-md-7 col-7">
              <div class="timeline-desc fs-3 text-dark mt-n1 p-0">{{$batch->quantity}}
                {{$batch->item->unit->name}}s
                of <span class="fw-semibold">{{$batch->item->item}}</span><br><span
                class="text-primary">#Batch Id :{{$batch->batch_id}}</span>
              </div>
              </div>
            </div>
            </li>
          @endforeach
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Recent Transactions</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Batch Id</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Product</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Type</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Quantity</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($transaction as $transactions)
              <tr>
              <td class="border-bottom-0">
                <h6 class="mb-0">{{$transactions->batch_id}}</h6>
              </td>
              <td class="border-bottom-0">
                <h6 class="mb-1">{{$transactions->item->item}}</h6>
                <span class="fw-normal">{{$transactions->item->category->category}} |
                {{$transactions->item->subcategory->subcategory}}</span>
              </td>
              <td class="border-bottom-0">
                <div class="d-flex align-items-center gap-2">
                <span
                  class="badge {{$transactions->change_type === 'restock' ? 'bg-success' : 'bg-danger'}} rounded-3 fw-semibold">{{ucfirst($transactions->change_type)}}</span>
                </div>
              </td>
              <td class="border-bottom-0">
                <p class="mb-0 fw-medium">{{$transactions->change_quantity}}</p>
              </td>
              </tr>
            @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  @include('Admin/common/footer-link')

</body>

</html>