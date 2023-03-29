<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->u1 = $this->uri->segment(1);

        if (empty($this->session->userdata('log_user'))) {
            $this->dt_user = null;
        } else {
            $this->db->where('id', $this->session->userdata('id'));
            $this->dt_user = $this->db->get('user')->row();
        }

        $this->load->model('M_Front', 'front');
    }

    private function _authentication()
    {
        if (empty($this->session->userdata('log_user'))) {
            $this->session->set_flashdata('toastr-error', 'Silahkan login dahulu!');
            redirect('auth', 'refresh');
        }
    }

    public function index()
    {
        $data = [
            'title'           => 'Home | Citra Bakery',
            'page'            => 'frontend/home',
            'kategori'        => $this->front->getKategori(),
            'products'        => $this->front->getPopularProducts(),
            'productKategori' => $this->front->getProductKategori()
        ];

        $this->load->view('frontend/index', $data);
    }

    public function shop($id = null, $filter = null, $page = null)
    {
        if (!$id) {
            $kategori = $this->front->getKategori();
            $id       = $kategori[0]->id;
        }

        $like = null;

        if ($filter == 1) {
            $filter = 1;
            $where = [
                'kategori_id' => $id
            ];
        } elseif ($filter == 2) {
            $where = [
                'kategori_id' => $id,
                'harga <'     => 30000
            ];
        } elseif ($filter == 3) {
            $where = [
                'kategori_id' => $id,
                'harga >='    => 30000,
                'harga <='    => 50000
            ];
        } elseif ($filter == 4) {
            $where = [
                'kategori_id' => $id,
                'harga >'     => 50000
            ];
        } else {
            if ($filter != null) {
                $where = [
                    'kategori_id' => $id
                ];

                $like = $filter;
            } else {
                $filter = 1;
                $where = [
                    'kategori_id' => $id
                ];
            }
        }

        $countProductByPrice = [
            1 => $this->front->getCountProduct([
                'kategori_id' => $id
            ]),
            2 => $this->front->getCountProduct([
                'kategori_id' => $id,
                'harga <'     => 30000
            ]),
            3 => $this->front->getCountProduct([
                'kategori_id' => $id,
                'harga >='    => 30000,
                'harga <='    => 50000
            ]),
            4 => $this->front->getCountProduct([
                'kategori_id' => $id,
                'harga >'     => 50000
            ]),
        ];

        // echo json_encode($where);
        // die;

        $per_page = 6;

        $products = $this->front->getProductsShop($where, $per_page, $this->_paging_offset($page, $per_page), $like);

        $total_rows = $this->front->getCountProduct($where, $like);

        $data = [
            'title'        => 'Shop | Citra Bakery',
            'page'         => 'frontend/shop',
            'kategori'     => $this->front->getKategori(),
            'products'     => $products,
            'kategori_ini' => $id,
            'filter'       => $filter,
            'countProduct' => $countProductByPrice,
            'paging'       => $this->_paging(base_url('shop/') . $id . '/' . $filter, $total_rows, $per_page),
            'total_rows'   => $total_rows
        ];

        $this->load->view('frontend/index', $data);
    }

    public function detail($id)
    {
        $product = $this->front->getProduct([
            'menu.id' => $id
        ]);

        $gambar = $this->front->getGambar([
            'idMenu' => $id
        ]);

        $data = [
            'title'    => 'Shop Detail | Citra Bakery',
            'page'     => 'frontend/detail',
            'kategori' => $this->front->getKategori(),
            'product'  => $product,
            'gambar'   => $gambar,
            'products' => $this->front->getProductRandom($id)
        ];

        $this->load->view('frontend/index', $data);
    }

    public function contact()
    {
        $data = [
            'title'    => 'Contact | Citra Bakery',
            'page'     => 'frontend/contact',
            'kategori' => $this->front->getKategori()
        ];

        $this->load->view('frontend/index', $data);
    }

    public function cart()
    {
        $this->_authentication();

        $cart = $this->front->getCart([
            'keranjang.idUser' => $this->dt_user->id,
            'keranjang.status' => 0
        ]);

        $data = [
            'title'    => 'Cart | Citra Bakery',
            'page'     => 'frontend/cart',
            'kategori' => $this->front->getKategori(),
            'cart'     => $cart
        ];

        $this->load->view('frontend/index', $data);
    }

    public function checkout()
    {
        $data = [
            'title'    => 'Checkout | Citra Bakery',
            'page'     => 'frontend/checkout',
            'kategori' => $this->front->getKategori()
        ];

        $this->load->view('frontend/index', $data);
    }

    public function addToCart()
    {
        $this->_authentication();

        $menu = $this->front->getMenu([
            'id' => $this->input->post('idMenu')
        ]);

        $cek = $this->front->checkCart([
            'idUser' => $this->dt_user->id,
            'idMenu' => $this->input->post('idMenu')
        ]);

        if ($cek) {
            $this->session->set_flashdata('toastr-error', 'The product is already in your cart');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }

        if ($menu->stok < 1) {
            $this->session->set_flashdata('toastr-error', 'Product is sold out');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }

        if ($this->input->post('total') == null) {
            $data = [
                'idUser' => $this->dt_user->id,
                'idMenu' => $this->input->post('idMenu')
            ];
        } else {
            $data = [
                'idUser' => $this->dt_user->id,
                'idMenu' => $this->input->post('idMenu'),
                'total'  => $this->input->post('total')
            ];
        }

        $insert = $this->db->insert('keranjang', $data);

        if ($insert) {
            $this->session->set_flashdata('toastr-success', 'The product has been successfully added to your cart');
        } else {
            $this->session->set_flashdata('toastr-error', 'Product failed to add to your cart');
        }

        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

    public function deleteCart()
    {
        $this->db->where('id', $this->input->post('id'));
        $delete = $this->db->delete('keranjang');

        if ($delete) {
            $this->session->set_flashdata('toastr-success', 'Successfully deleted the product in the cart');
        } else {
            $this->session->set_flashdata('toastr-error', 'Failed to delete product in cart!!');
        }

        redirect('cart', 'refresh');
    }

    public function updateQuantity()
    {
        $id = $this->input->post('id');
        $total = $this->input->post('total');

        $data = [
            'total' => $total
        ];

        $this->db->where('id', $id);
        $update = $this->db->update('keranjang', $data);

        if ($update) {
            $total = $this->front->getTotalPrice([
                'keranjang.idUser' => $this->dt_user->id,
                'keranjang.status' => 0
            ]);

            $res = [
                'status' => true,
                'total' => 'Rp. ' . number_format($total->total, 0, ',', '.')
            ];
        } else {
            $res = [
                'status' => false
            ];
        }

        echo json_encode($res);
    }

    private function _paging_offset($page, $limit)
    {
        if ($page > 1) {
            $offset = ($page - 1) * $limit;
        } else {
            $offset = $page;
        }

        return $offset;
    }

    private function _paging_tag()
    {
        $config['full_tag_open']    = "<ul class='pagination justify-content-center mb-3 my-auto'>";
        $config['full_tag_close']   = "</ul>";
        $config['first_tag_open']   = "<li class='page-link'>";
        $config['first_tag_close']  = "</li>";
        $config['next_tag_open']    = "<li class='page-link'>";
        $config['next_tag_close']   = "</li>";
        $config['cur_tag_open']     = "<li class='page-link active bg-primary text-white'><a>";
        $config['cur_tag_close']    = "</a></li>";
        $config['num_tag_open']     = "<li class='page-link'>";
        $config['num_tag_close']    = "</li>";
        $config['prev_tag_open']    = "<li class='page-link'>";
        $config['prev_tag_close']   = "</li>";
        $config['last_tag_open']    = "<li class='page-link'>";
        $config['last_tag_close']   = "</li>";
        $config['first_link']       = "First";
        $config['last_link']        = "Last";
        $config['next_link']        = "&raquo;";
        $config['prev_link']        = "&laquo;";

        return $config;
    }

    private function _paging($base_url, $total_rows, $per_page)
    {
        $this->load->library('pagination');
        $config                             = $this->_paging_tag();
        $config['base_url']                 = $base_url;
        $config['total_rows']               = $total_rows;
        $config['per_page']                 = $per_page;
        $config['use_page_numbers']         = TRUE;
        $config['reuse_query_string']       = TRUE;

        $this->pagination->initialize($config);

        return $this->pagination->create_links();
    }
}

  /* End of file Frontend.php */
