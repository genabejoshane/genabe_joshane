<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Author extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->call->model('Author_model');
        if (!isset($_SESSION['user'])) {
            redirect('auth/login');
        }
    }

    public function all() 
    {
        
        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
         }

        $records_per_page = 10;

    $all = $this->author_model->page($q, $records_per_page, $page);
    $data['all'] = $all['records'];
    $total_rows = $all['total_rows'];
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap'); // or 'tailwind', or 'custom'
        $this->pagination->initialize($total_rows, $records_per_page, $page, site_url('author').'?q='.$q);
        $data['page'] = $this->pagination->paginate();
        $this->call->view('authors', $data);
    }
        // Create author (POST)
        public function create() {
            if ($this->io->post()) {
                $data = [
                    'first_name' => $this->io->post('first_name'),
                    'last_name' => $this->io->post('last_name'),
                    'birthdate' => $this->io->post('birthdate'),
                    'email' => $this->io->post('email'),
                    'added' => date('Y-m-d H:i:s')
                ];
                $this->author_model->create($data);
                redirect('author');
            } else {
                $this->call->view('author_create');
            }
        }

        // Edit author (GET)
        public function edit($id) {
            $data['author'] = $this->author_model->edit($id);
            $this->call->view('author_edit', $data);
        }

        // Update author (POST)
        public function update($id) {
            if ($this->io->post()) {
                $data = [
                    'first_name' => $this->io->post('first_name'),
                    'last_name' => $this->io->post('last_name'),
                    'birthdate' => $this->io->post('birthdate'),
                    'email' => $this->io->post('email')
                ];
                $this->author_model->update_author($id, $data);
                redirect('author'); // After update, go back to student list
            }
        }

        // Delete author (GET or POST)
        public function delete($id) {
            $this->author_model->delete($id);
            redirect('author');
        }
}
?>
