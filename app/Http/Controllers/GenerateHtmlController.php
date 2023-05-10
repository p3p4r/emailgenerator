<?php
namespace App\Http\Controllers;

use App\GenerateHtml;
use App\Headers;
use App\RowHtml;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use JavaScript;
use Lang;
use Session;
use View;

class GenerateHtmlController extends Controller
{
    private $hd_file_path;
    private $ct_file_path;
    private $ft_file_path;
    private $jsvar;
    private $editor;
    private $user;
    public function __construct() // Global variables

    {
        $this->editor = false;
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if (Auth::check() == true && $this->user->admin == 1) {
                // if is logged in and Admin
                $this->editor = true;
            }
             // Convert php to Javascript for Font Pciker on Input and translations 
            $jsvar = JavaScript::put([
                'editor' => $this->editor,
                'lang_color'    => Lang::get('generator.color'),
                'lang_fontSize' => Lang::get('generator.font_size'),
                'lang_weight'   => Lang::get('generator.weight'),
                'lang_bold'     => Lang::get('generator.bold'),
                'lang_normal'   => Lang::get('generator.normal'),
                'lang_align'    => Lang::get('generator.align'),
                'lang_left'     => Lang::get('generator.left'),
                'lang_center'   => Lang::get('generator.center'),
                'lang_right'    => Lang::get('generator.right'),
            ]);
            return $next($request);
        });

        // javascript put editor middleware must be inside
        $this->hd_file_path = File::allFiles(resource_path('views/dashboard/generatehtml/header'));
        $this->ct_file_path = File::allFiles(resource_path('views/dashboard/generatehtml/rows_template'));
        $this->ft_file_path = File::allFiles(resource_path('views/dashboard/generatehtml/footer'));
        $image_url          = url('/images/mail_generator_newsletter'); // used inside of tempaltes
        View::share('image_url', $image_url);
            
    }

    public function index()
    {
        $month        = date('m');
        $day          = date('d');
        $year         = date('Y');
        $currentDate = $day . '-' . $month . '-' . $year;

        $htmls = GenerateHtml::orderBy('id', 'desc')->paginate(30);
        $rows  = RowHtml::where('type', 'ct')->groupBy('html_id')->orderBy('html_id', 'DESC')->get();

        return view('dashboard.generatehtml.index', ['htmls' => $htmls, 'rows' => $rows, 'currentDate' => $currentDate]);
    }

    public function create()
    {
        $month        = date('F');
        $day          = date('d');
        $year         = date('Y');
        $imgPathValue = $year . '/' . $day . '-' . $month;
        /*   $title= $this->createInput('','','title','titleId','100%','100%','0','30px');
        $content = $this->createTexarea('','','content','380px','contentID','100%','100%','0','30px');
        $signature= $this->createInput('','','signature','signatureId','100%','100%','0','30px'); */
        $imgPath = $this->createInput($imgPathValue, '', 'img_path', 'img_pathID', '100%', '100%', '0', '12px');

        return view('dashboard.generatehtml.create',
            [
                'imgPath'            => $imgPath,
                'header_templates'   => $this->hd_file_path,
                'rows_templates'     => $this->ct_file_path,
                'footer_templates'   => $this->ft_file_path,
                'total_hd_templates' => count($this->hd_file_path),
                'total_ct_templates' => count($this->ct_file_path),
                'total_ft_templates' => count($this->ft_file_path),
                'jsvar'              => $this->jsvar,
            ]);
    }

    public function redirectForm(Request $r)
    {
        $this->downloadContent($r);
    }

    public function templateHeader($id_hd)
    {
        foreach ($this->hd_file_path as $tmp_id => $value) {
            return view('dashboard.generatehtml.header.template' . $id_hd,
                [
                    'id_hd' => $id_hd,
                ])->render();
        }
    }

    public function templateRow($id_ct)
    {
        $var = '_count';
        foreach ($this->ct_file_path as $tmp_id => $value) {
            return view('dashboard.generatehtml.rows_template.template' . $id_ct,
                [
                    'id_ct' => $id_ct,
                    'var'   => $var,
                ])->render();
        }
    }

    public function templateFooter($id_ft)
    {
        foreach ($this->ft_file_path as $tmp_id => $value) {
            return view('dashboard.generatehtml.footer.template' . $id_ft,
                [
                    'id_ft' => $id_ft,
                ])->render();
        }
    }

    public function downloadContent(Request $r)
    {
        $id               = $r->id;
        $template         = $r->template;
        $counterContainer = $r->counterContainer;
        $summary          = $r->summary;
        //$rows_templates    = RowsTemplate::orderBy('id', 'asc')->get();
        $header_row  = RowHtml::where('html_id', $id)->where('type', RowHtml::HEADER_TYPE)->orderBy('id', 'asc')->get()->pluck('content');
        $content_row = RowHtml::where('html_id', $id)->where('type', RowHtml::CONTENT_TYPE)->orderBy('id', 'asc')->get()->pluck('content');
        $styles_row  = RowHtml::where('html_id', $id)->where('type', RowHtml::CONTENT_TYPE)->orderBy('id', 'asc')->get()->pluck('styles');
        $footer_row  = RowHtml::where('html_id', $id)->where('type', RowHtml::FOOTER_TYPE)->orderBy('id', 'asc')->get()->pluck('content');
        $rows        = RowHtml::where('html_id', $id)->where('type', RowHtml::CONTENT_TYPE)->orderBy('id', 'asc')->get()->toArray();
        $header      = RowHtml::where('html_id', $id)->where('type', RowHtml::HEADER_TYPE)->get();
        $footer      = RowHtml::where('html_id', $id)->where('type', RowHtml::FOOTER_TYPE)->get();
        $public_path = unserialize($content_row[0])['imagePath'];
        // Info Container
        $title        = $r->title;
        $subtitle     = $r->subtitle;
        $content      = $r->content;
        $signature    = $r->signature;
        $imagePath    = $r->img_path;
        $align        = $r->counterContainer;
        $imgUrl       = $r->imagelink;
        $imageName    = $r->imageName;
        $imageData    = $r->imageData;
        $color        = $r->colortmp;
        $row_template = $r->rowTemplate;
        $hd_path      = 'dashboard.generatehtml.header.template';
        $ft_path      = 'dashboard.generatehtml.footer.template';
        $ct_path      = 'dashboard.generatehtml.rows_template.template';
        /* $rows_templates   = $this->ct_file_path;*/
        //$all = compact(['title', 'subtitle', 'content', 'signature', 'imagePath', 'imageData', 'align', 'imgUrl', 'imageName', 'color', 'template', 'row_template']);
        // Content Header
        $hd_row = [];
        foreach ($header_row as $position => $rows_hd) {
            if (!empty($rows_hd)) {
                $rows_hd = unserialize($rows_hd);
                foreach ($rows_hd as $hd_name => $hd_content) {
                    if (isset($hd_content)) {
                        $hd_row[$position][$hd_name] = $hd_content;
                    }
                }
            }
        }
        // Variable $var for each template
        $var = 0;
        // Content Row
        $cnt_row = [];
        $styles  = [];
        foreach ($content_row as $position => $rows_cnt) {
            // styles for each content input
            if (!empty($styles_row[$position])) {
                $stl = unserialize($styles_row[$position]);
                foreach ($stl as $row_style => $style_content) {
                    if (isset($style_content)) {
                        $styles[$position][$row_style] = $style_content;
                    }
                }
            }
            $rows_cnt = unserialize($rows_cnt);
            foreach ($rows_cnt as $row_name => $row_content) {
                if (isset($row_content)) {
                    $cnt_row[$position][$row_name] = $row_content;
                }
            }
            $template_id = $rows[$position]['template_id'];
            $color       = $rows_cnt['color'];
            $img_path    = $rows_cnt['imagePath'];
            $blueLink    = url("/generateHtml") . '/' . $img_path;
        }
        // Footer Row
        $ft_row = [];
        foreach ($footer_row as $position => $rows_ft) {
            if (!empty($rows_ft)) {
                $rows_ft = unserialize($rows_ft);
                foreach ($rows_ft as $ft_name => $ft_content) {
                    if (isset($ft_content)) {
                        $ft_row[$position][$ft_name] = $ft_content;
                    }
                }
            }
        }
        if ($template == 'peoplept') {
            $path         = 'newsletter/footer_images/';
            $multi_images = array(
                'social_youtube.png',
                'social_twitter.png',
                'social_linkedin.png',
                'social_facebook.png',
                'logo_name.jpg',
                'logo_icon_no_background.png',
                'normal_footer.jpg',
            );
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            foreach ($multi_images as $key => $footer_img_name) {
                $defaultPath = public_path() . '/images/mail_generator_newsletter/' . $footer_img_name;
                $path_a      = $path . $footer_img_name;
                File::copy($defaultPath, $path_a);
            }
        }
        $download = '';
        $html     = view('dashboard.generatehtml.htmlTemplate',
            [
                'counterContainer' => $counterContainer,
                'summary'          => $summary,
                'template'         => $template,
                'template_id'      => $template_id,
                'rows_templates'   => $this->ct_file_path,
                'header_templates' => $this->hd_file_path,
                'footer_templates' => $this->ft_file_path,
                'hd_path'          => $hd_path,
                'ct_path'          => $ct_path,
                'ft_path'          => $ft_path,
                'footer'           => $footer,
                'header'           => $header,
                'color'            => $color,
                'img_path'         => $img_path,
                'blueLink'         => $blueLink,
                'hd_row'           => $hd_row,
                'rows'             => $rows,
                'download'         => $download,
                'var'              => $var,
                'hd_row'           => $hd_row,
                'cnt_row'          => $cnt_row,
                'ft_row'           => $ft_row,
                'styles'           => $styles,
                'jsvar'            => $this->jsvar,
            ]
        )->render();
        $a         = preg_replace('/\s+/', ' ', $html); /* Remove Long White Spaces */
        $b         = preg_replace('/(<input[^>]+) name=".*?"/i', '<p', $a); /* Change input with <p> */
        $c         = preg_replace('/(<p) value=".*?"/i', '<p', $b); /* Remove Input Value  */
        $d         = preg_replace('/(<textarea[^>]+) /i', '<p', $c); /* Change textarea with <p>  */
        $e         = preg_replace('/id=".*?"/', '', $d); /* Remove Class Attribute Value  */
        $f         = preg_replace('/class=".*?"/', '', $e); /* Remove Class Attribute Value  */
        $name_file = 'generatedEmail.html';
        header("Content-type: text/html");
        header("Content-Disposition: attachment; filename='" . $name_file . "'");
        Storage::disk('public_path')->put('/' . $public_path . $name_file, $f); // copy to public path
        print_r($f); // to see view without download use: "print($html)"
    }

    public function saveHtml(Request $r)
    {
        $countRows = $r->counterContainer;
        if (isset($countRows)) {
            // Image Upload
            $template    = $r->template;
            $images      = $r->imageuploud;
            $default_img = $r->default_img;
            $summary     = $r->summary;
            $footer_id   = $r->ftId;
            $header_id   = $r->hdId;

            if (!isset($footer_id)) {
                $footer_id = 1;
            }
            if (!isset($header_id)) {
                $header_id = 1;
                $template  = 'noheader';
            }

            /*  $path = 'images/generateHtml/'.$r->img_path[0].'/';  // images/generateHtml/2018/*/
            $path = 'newsletter/' . $template . '/' . $r->img_path[0] . '/'; // images/generateHtml/2018/
            if (isset($template)) {

                if (isset($images)) {
                    foreach ($images as $key => $image) {
                        $imageName  = $image->getClientOriginalName();
                        $image_path = $path . $imageName;

                        if (!File::exists($path)) {
                            File::makeDirectory($path, $mode = 0777, true, true);
                        }
                        $image->move($path, $imageName);
                    }
                } else if (isset($default_img) || $default_img == '0') {
                    // inser iamge default
                    Session::flash('flash_error', "Insert all images");
                    return redirect()->back();
                }

                $template   = array('name' => $template);
                $htmlCreate = GenerateHtml::create($template);

                if (isset($r->colortmp)) {
                    $color = $r->colortmp;
                } else {
                    $color = "#000";
                }

                // Insert Header
                if (isset($header_id)) {
                    if (isset($summary)) {
                        $summary = $summary;
                    } else {
                        $summary = '';
                    }

                    $hdr = $r->header;

                    if (isset($hdr)) {
                        $header = [];
                        foreach ($hdr as $hd_key => $hd_val) {
                            foreach ($hd_val as $hdr_postion => $header_row) {
                                if (isset($header_row)) {
                                    $header[$hdr_postion] = $header_row;
                                }
                            }
                        }
                        $headerMerged = serialize($header);
                    } else {
                        $headerMerged = '';
                    }

                    $sendHeader = array(
                        'html_id'     => $htmlCreate->id,
                        'content'     => $headerMerged,
                        'align'       => '0', // 0 -> no alignment
                        'type'        => RowHtml::HEADER_TYPE,
                        'template_id' => $header_id,
                        'styles'      => '',
                    );
                    RowHtml::create($sendHeader);
                }
                // Insert Content
                foreach ($countRows as $key => $align) {

                    $content = [];
                    $styles  = [];

                    if (isset($r->rowTemplate[$key])) {
                        $row_template = $r->rowTemplate[$key];
                    } else {
                        $row_template = '0';
                    }

                    /* ---- Save Content ---- */
                    $cnt = $r->content[$key];
                    foreach ($cnt as $cnt_postion => $content_row) {
                        if (isset($content_row)) {
                            $content[$cnt_postion] = $content_row;
                        }
                    }

                    if (isset($r->imageuploud[$key])) {
                        $content['imageName'] = $r->imageuploud[$key]->getClientOriginalName();
                    }
                    if (isset($r->imagelink[$key])) {
                        $content['imagelink'] = $r->imagelink[$key];
                    }
                    if (isset($path)) {
                        $content['imagePath'] = $path;
                    }
                    if (isset($color)) {
                        $content['color'] = $color;
                    }

                    $contentMerged = serialize($content);
                    $sufix         = '_style';
                    /* ---- Update Styles ---- */
                    if (isset($r->styles[$key])) {
                        $cnt_styles = $r->styles[$key];
                        foreach ($cnt_styles as $style_pos => $style_cnt_row) {
                            if (isset($style_cnt_row)) {
                                $styles[$style_pos . $sufix] = $style_cnt_row;
                            } else {
                                $styles[$style_pos . $sufix] = '';
                            }
                        }
                    }
                    $stylesMerged = serialize($styles);

                    $sendContent = array(
                        'html_id'     => $htmlCreate->id,
                        'content'     => $contentMerged,
                        'align'       => $align, //  1 - Left [default] | 2 - Right -----> send by the counter, is hidden
                        'type'        => RowHtml::CONTENT_TYPE, // ct -> content
                        'template_id' => $row_template,
                        'styles'      => $stylesMerged,
                    );
                    RowHtml::create($sendContent);
                }

                // Insert Footer
                if (isset($footer_id)) {
                    $ft = $r->footer;

                    if (isset($ft)) {
                        $footer = [];
                        foreach ($ft as $ft_key => $ft_val) {
                            foreach ($ft_val as $ft_postion => $footer_row) {
                                if (isset($footer_row)) {
                                    $footer[$ft_postion] = $footer_row;
                                }
                            }
                        }
                        $footerMerge = serialize($footer);
                    } else {
                        $footerMerge = '';
                    }

                    $sendFooter = array(
                        'html_id'     => $htmlCreate->id,
                        'content'     => $footerMerge,
                        'align'       => '0', // 0 -> no alignment
                        'type'        => RowHtml::FOOTER_TYPE,
                        'template_id' => $footer_id,
                        'styles'      => '',
                    );
                    RowHtml::create($sendFooter);
                }

                /*  Create Footer here  */
                $last_id = $htmlCreate->id;

                return redirect()->route('html.edit', $last_id);
            }

            Session::flash('flash_error', "Choose one Template.");
            return redirect()->back();
        }
        Session::flash('flash_error', "Please Insert at least one row.");
        return redirect()->back();
    }

    public function update($id, Request $r)
    {
        // Global function variables
        $main_row     = GenerateHtml::where('id', $id)->get();
        $html         = RowHtml::where('html_id', $id)->get();
        $getHeader    = RowHtml::where('type', 'hd')->where('html_id', $id)->get();
        $getContent   = RowHtml::where('type', 'ct')->where('html_id', $id)->orderBy('id', 'asc')->get();
        $getFooter    = RowHtml::where('type', 'ft')->where('html_id', $id)->get();
        $id_DB_Header = $getHeader[0]['id'];
        $id_DB_Footer = $getFooter[0]['id'];

        $countRows       = $r->counterContainer; // Row from the Form
        $total_rows_form = count($countRows);
        $total_rows_DB   = count($getContent);
        $rowsIds         = $r->rowId;

        // Replace Folder If Template Header Change
        $old_tmp_id          = $getHeader[0]['template_id'];
        $new_tmp_id          = $r->header;
        $r_path              = $r->img_path[0];
        $old_tmp_name        = $main_row[0]['name'];
        $new_tmp_name        = $r->template;
        $old_dir_defaultPath = public_path() . '/newsletter/' . $old_tmp_name . '/' . $r_path;
        $new_dir_defaultPath = public_path() . '/newsletter/' . $new_tmp_name . '/' . $r_path;
        if ($old_tmp_id != $new_tmp_id) {
            if (File::exists($old_dir_defaultPath)) {
                File::moveDirectory($old_dir_defaultPath, $new_dir_defaultPath);
            }
        }
        // remove the header for edit or adding rows
        if ($total_rows_form > $total_rows_DB) {
            //print("Form tem mais (>) rows que na BD");
            $this->updateHeader($r, $id, $id_DB_Header, $getHeader);
            $this->actionRows($r, $id, 0, $countRows, $getContent, $rowsIds, $id_DB_Header);
            $this->updateFooter($r, $id, $id_DB_Footer);
        }
        if ($total_rows_form < $total_rows_DB) {
            //print("Form tem menos (<) rows que na BD");
            $this->updateHeader($r, $id, $id_DB_Header, $getHeader);
            $this->actionRows($r, $id, 1, $countRows, $getContent, $rowsIds, $id_DB_Header);
            $this->updateFooter($r, $id, $id_DB_Footer);

        }
        if ($total_rows_form == $total_rows_DB) {
            //print("Form tem igual (=) rows que na BD");
            $this->updateHeader($r, $id, $id_DB_Header, $getHeader);
            $this->actionRows($r, $id, 2, $countRows, $getContent, $rowsIds, $id_DB_Header);
            $this->updateFooter($r, $id, $id_DB_Footer);
        }
        return redirect()->route('html.edit', $id);
    }

    // Update Header
    public function updateHeader($r, $id, $id_DB_Header, $getHeader)
    {
        $header_id   = $r->hdId; // template header Id
        $header_name = $r->template; // template header Name
        $hdr         = $r->header;

        if (isset($hdr)) {
            $header = [];
            foreach ($hdr as $hd_key => $hd_val) {
                foreach ($hd_val as $hdr_postion => $header_row) {
                    if (isset($header_row)) {
                        $header[$hdr_postion] = $header_row;
                    }
                }
            }
            $headerMerged = serialize($header);
        } else {
            $headerMerged = '';
        }

        $sendHeader = array(
            'html_id'     => $id,
            'content'     => $headerMerged,
            'align'       => '0', // 0 -> no alignment
            'type'        => RowHtml::HEADER_TYPE,
            'template_id' => $header_id,
            'styles'      => '',
        );
        RowHtml::findOrFail($id_DB_Header)->update($sendHeader);
        // Update Main Row
        GenerateHtml::findOrFail($id)->update(['name' => $header_name]);
    }
    public function updateFooter($r, $id, $id_DB_Footer)
    {
        $footer_id = $r->ftId;
        $ft        = $r->footer;

        if (isset($ft)) {
            $footer = [];
            foreach ($ft as $ft_key => $ft_val) {
                foreach ($ft_val as $ft_postion => $footer_row) {
                    if (isset($footer_row)) {
                        $footer[$ft_postion] = $footer_row;
                    }
                }
            }
            $footerMerge = serialize($footer);
        } else {
            $footerMerge = '';
        }

        $footer = array(
            'html_id'     => $id,
            'content'     => $footerMerge,
            'align'       => '0', // 0 -> no alignment
            'type'        => RowHtml::FOOTER_TYPE,
            'template_id' => $footer_id,
            'styles'      => '',
        );
        RowHtml::findOrFail($id_DB_Footer)->update($footer);
    }

    public function actionRows($r, $id, $action, $countRows, $getContent, $rowsIds, $id_DB_Header)
    {
        // var action receive if will:
        # Update and add in DB [0]
        # No changes, just update [1]
        # Update and delete in DB [2]
        # Delete All [3]
        $existImage  = $r->imageName;
        $uplouadFile = $r->imageuploud;
        $folder      = 'newsletter/';
        $template    = $r->template;
        $path        = $folder . $template . '/' . $r->img_path[0]; // images/generateHtml/2018/
        $imageUrl    = $r->imageUrl;
        $img_name    = array();
        // Delete
        if ($action == 3) {
            foreach ($html as $key => $value) {
                $value->where('type', 'ct')->delete();
                return redirect()->route('generatehtml.index');
            }
        }

        if (isset($existImage)) {
            foreach ($existImage as $key => $imageName) {
                if (is_null($imageName) || $imageName == 'default.jpg' || $imageName == 'default.png') {
                    // check if is null and no file was uplouad
                    if (!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }
                    $imageName   = "default.png";
                    $defaultPath = public_path() . '/' . $folder . $imageName;
                    $imageUrl    = $r->imageUrl[$key];
                    $path1       = $path . $imageName;
                    File::copy($defaultPath, $path1);
                    $img_name[] = array(
                        'index' => $key,
                        'name'  => $imageName,
                        'url'   => $imageUrl,
                    );
                }
                if (!is_null($imageName) && $r->hasFile('imageuploud') == true) {
                    foreach ($uplouadFile as $keyFile => $fileUpload) {
                        // Check if file was upload and replace at the position that was uploaded
                        if ($keyFile == $key) {
                            $imageName  = $r->imageuploud[$key]->getClientOriginalName();
                            $image_path = $path . $imageName;
                            $imageUrl   = $r->imagelink[$key];
                            if (!File::exists($path)) {
                                File::makeDirectory($path, $mode = 0777, true, true);
                            }
                            $fileUpload->move($path, $imageName);
                            $img_name[] = array(
                                'index' => $key,
                                'name'  => $imageName,
                                'url'   => $imageUrl,
                            );
                        }
                    }
                }
            }
        }

        // insert
        foreach ($countRows as $key => $align) {
            $content = [];
            $styles  = [];
            $color   = $r->colortmp;

            if (isset($r->rowTemplate[$key])) {
                $row_template = $r->rowTemplate[$key];
            } else {
                $row_template = '0';
            }
            /* ---- Update Content ---- */
            if (isset($r->content[$key])) {
                $cnt = $r->content[$key];
                foreach ($cnt as $cnt_postion => $content_row) {
                    if (isset($content_row)) {
                        $content[$cnt_postion] = $content_row;
                    } else {
                        $content[$cnt_postion] = '';
                    }
                }
            }

            /* ----- Image ----- */
            if (isset($r->imageuploud[$key])) {
                $content['imageName'] = $r->imageuploud[$key]->getClientOriginalName();
            }
            if (isset($r->imagelink[$key])) {
                $content['imagelink'] = $r->imagelink[$key];
            }
            if (isset($r->imageName[$key])) {
                $content['imageName'] = $r->imageName[$key];
            }
            if (isset($r->imageUrl[$key])) {
                $content['imagelink'] = $r->imageUrl[$key];
            } /* ----- end Image ----- */
            if (isset($path)) {
                $content['imagePath'] = $path;
            }
            if (isset($color)) {
                $content['color'] = $color;
            }

            if (isset($r->imageName[$key]) && isset($r->imageUrl[$key])) {
                $aux_name = $r->imageName[$key];
                $aux_url  = $r->imageUrl[$key];

                foreach ($img_name as $info) {
                    if ($key == $info['index']) {
                        $aux_name = $info['name'];
                        $aux_url  = $info['url'];
                    }
                }

            }

            $contentMerged = serialize($content);
            $sufix         = '_style';
            /* ---- Update Styles ---- */
            if (isset($r->styles[$key])) {
                $cnt_styles = $r->styles[$key];
                foreach ($cnt_styles as $style_pos => $style_cnt_row) {
                    if (isset($style_cnt_row)) {
                        $styles[$style_pos . $sufix] = $style_cnt_row;
                    } else {
                        $styles[$style_pos . $sufix] = '';
                    }
                }
            }
            $stylesMerged = serialize($styles);

            $sendContent = array(
                'html_id'     => $id,
                'content'     => $contentMerged,
                'align'       => $align, //  1 - Left [default] | 2 - Right -----> send by the counter, is hidden
                'type'        => RowHtml::CONTENT_TYPE, // ct -> content
                'template_id' => $row_template,
                'styles'      => $stylesMerged,
            );

            if ($action == 0) {
                /*dd($r);*/
                $countDB    = count($getContent);
                $idRow_form = $rowsIds[$key]; // Form Id's
                $newIds     = '0' . $key;

                if ($idRow_form != $newIds) {
                    RowHtml::findOrFail($idRow_form)->update($sendContent);
                } else {
                    RowHtml::create($sendContent);
                }
            }

            if ($action == 1) {
                $idRow = $getContent; // database id's
                if (isset($rowsIds)) {
                    $action = 2;
                }
            }

            if ($action == 2) {
                $idRow = $getContent[$key]['id'];
                RowHtml::findOrFail($idRow)->update($sendContent);
            }
        }
        if (isset($r->deleteId)) {
            $id_to_delete = $r->deleteId;
            foreach ($id_to_delete as $keys => $deleteIds) {
                if (isset($deleteIds)) {
                    RowHtml::findOrFail($deleteIds)->delete();
                }
            }
        }

    }

// APROVEITAR ESTA IDEIA E GEREAR MULTIPLOS INPUTS E TEXTAREA E IMAGENS
    // USANDO FOR / FOREACH E Aproveitando os Arrays
    public static function createInput($value, $counter, $name, $id, $width, $height, $margin, $fontSize)
    {

        return ' <div style="margin: 10px 0px;"> <input type="text" name="' . $name . '[' . $counter . ']" placeholder="Insert text in here" style="margin:  ' . $margin . ';width:  ' . $width . '; height: ' . $height . ';font-size:' . $fontSize . ';" value="' . $value . '" id="' . $id . '_' . $counter . '" > </div>';

    }

    public static function createTexarea($value, $counter, $name, $id, $width, $height, $margin, $fontSize)
    {
        return ' <div style="margin: 10px 0px;"> <textarea name="' . $name . '[' . $counter . ']" id="' . $id . '_' . $counter . '" class="textareaContent" placeholder="Insert text in this box" style="width: ' . $width . ';min-height: 120px; max-width: 380px; margin: 0px; height: 127px;margin:' . $margin . ';height:' . $height . ';font-size:' . $fontSize . ';">' . $value . '</textarea> </div>';
    }

    public function edit($id)
    {
        $header      = RowHtml::where('html_id', $id)->where('type', RowHtml::HEADER_TYPE)->get();
        $header_row  = RowHtml::where('html_id', $id)->where('type', RowHtml::HEADER_TYPE)->orderBy('id', 'asc')->get()->pluck('content');
        $rows        = RowHtml::where('html_id', $id)->where('type', RowHtml::CONTENT_TYPE)->orderBy('id', 'asc')->get()->toArray();
        $content_row = RowHtml::where('html_id', $id)->where('type', RowHtml::CONTENT_TYPE)->orderBy('id', 'asc')->get()->pluck('content');
        $styles_row  = RowHtml::where('html_id', $id)->where('type', RowHtml::CONTENT_TYPE)->orderBy('id', 'asc')->get()->pluck('styles');
        $footer_row  = RowHtml::where('html_id', $id)->where('type', RowHtml::FOOTER_TYPE)->orderBy('id', 'asc')->get()->pluck('content');
        $footer      = RowHtml::where('html_id', $id)->where('type', RowHtml::FOOTER_TYPE)->get();
        $template    = GenerateHtml::where('id', $id)->get()->toArray();
        $hd_path     = 'dashboard.generatehtml.header.template';
        $ct_path     = 'dashboard.generatehtml.rows_template.template';
        $ft_path     = 'dashboard.generatehtml.footer.template';
        $edit        = true;
        // Content Header
        $hd_row = [];
        foreach ($header_row as $position => $rows_hd) {
            if (!empty($rows_hd)) {
                $rows_hd = unserialize($rows_hd);
                foreach ($rows_hd as $hd_name => $hd_content) {
                    if (isset($hd_content)) {
                        $hd_row[$position][$hd_name] = $hd_content;
                    }
                }
            }
        }
        // Variable $var for each template
        $var = 0;
        // Content Row
        $cnt_row = [];
        $styles  = [];
        foreach ($content_row as $position => $rows_cnt) {
            // styles for each content input
            if (!empty($styles_row[$position])) {
                $stl = unserialize($styles_row[$position]);
                foreach ($stl as $row_style => $style_content) {
                    if (isset($style_content)) {
                        $styles[$position][$row_style] = $style_content;
                    }
                }
            }
            $rows_cnt = unserialize($rows_cnt);
            foreach ($rows_cnt as $row_name => $row_content) {
                if (isset($row_content)) {
                    $cnt_row[$position][$row_name] = $row_content;
                }
            }
            $template_id = $rows[$position]['template_id'];
            $color       = $cnt_row[$position]['color'];
        }
        // Footer Row
        $ft_row = [];
        foreach ($footer_row as $position => $rows_ft) {
            if (!empty($rows_ft)) {
                $rows_ft = unserialize($rows_ft);
                foreach ($rows_ft as $ft_name => $ft_content) {
                    if (isset($ft_content)) {
                        $ft_row[$position][$ft_name] = $ft_content;
                    }
                }
            }
        }
        return view('dashboard.generatehtml.edit',
            [
                "header"             => $header,
                "rows"               => $rows,
                'footer'             => $footer,
                'id'                 => $id,
                'template'           => $template,
                'hd_path'            => $hd_path,
                'ct_path'            => $ct_path,
                'ft_path'            => $ft_path,
                'color'              => $color,
                'template_id'        => $template_id,
                'hd_row'             => $hd_row,
                'cnt_row'            => $cnt_row,
                'ft_row'             => $ft_row,
                'header_templates'   => $this->hd_file_path,
                'rows_templates'     => $this->ct_file_path,
                'footer_templates'   => $this->ft_file_path,
                'total_hd_templates' => count($this->hd_file_path),
                'total_ct_templates' => count($this->ct_file_path),
                'total_ft_templates' => count($this->ft_file_path),
                'var'                => $var,
                'edit'               => $edit,
                'styles'             => $styles,
                'jsvar'              => $this->jsvar,
            ]);
    }

    public function destroy($id)
    {
        $filePath_BD    = RowHtml::where('html_id', $id)->where('type', RowHtml::CONTENT_TYPE)->get()->pluck('content')->first();
        $path           = '/' . unserialize($filePath_BD)['imagePath'];
        $folderTemplate = public_path($path);

        $html = GenerateHtml::findOrFail($id);
        $rows = RowHtml::where('html_id', $id);

        if (!empty($path)) {
            if (File::exists($folderTemplate)) {
                File::deleteDirectory($folderTemplate);
            }
        }

        // Delect Product
        $html->delete();
        $rows->delete();
        // delete images by path
        Session::flash('flash_message', "Row successfully deleted!");
        return redirect()->route('generatehtml.index');
    }

    public function headerCreate()
    {
        return view('dashboard.generatehtml.header.create');
    }

    public function copyRow($id)
    {
        $row       = GenerateHtml::find($id);
        $newParentRow = $row->replicate();
        $newParentRow->save();
        $rowsHtml  = RowHtml::where('html_id', $id)->get();
        foreach ($rowsHtml as $rowHtml ) {
            $newrowHtml          = $rowHtml->replicate();
            $newrowHtml->html_id = $newParentRow->id;
            $newrowHtml->save();
        }
        Session::flash('flash_message', "Copied Successfully! [Row: ".$newParentRow->id."]");
        return redirect()->back();
    }

    public function headerStore(Request $r)
    {
        $this->validate($r, [
            'name'    => 'required | min:3 | max:50 ', // unique:posts
            'image'   => 'required | mimes:png,jpg,jpeg| max:5000', // max: 5 MB
            'content' => 'max: 10000',
        ]);

        $formInput               = $r->except('image');
        $color                   = $r->colortmp;
        $name                    = $r->name;
        $name_for_path_no_spaces = $string = preg_replace('/\s+/', '', $name);
        $name_simple             = strtolower($name_for_path_no_spaces);
        $prefix_name             = 'header_';
        $image                   = $r->image;
        $path                    = public_path('/images/mail_generator_newsletter/');
        $path_img                = url('/images/mail_generator_newsletter') . '/';
        if (isset($image)) {
            $image_mime_type = $image->getMimeType();
            if ($image_mime_type == 'image/jpeg') {
                $mime = '.jpg';
            } else if ($image_mime_type == 'image/png') {
                $mime = '.png';
            }

            $full_image_path = $path_img . $prefix_name . $name_simple . $mime;

            $image_placeholder = '<td width="640" valign="top" style="width:640px;">\
                                    <a>\
                                        <img width="640" style="display:block !important;" border="0" src="' . $full_image_path . '" alt="' . $name . '">\
                                    </a>\
                                ';
        } else {
            $image_placeholder = '';
        }
        $content_hd = '<tr class="headerContent">\
                        <input id="generalColor" name="colortmp" type="hidden" class="input-group-addon" value="' . $color . '" >\
                         ' . $image_placeholder . '\
                         <span class="hd_clr" style="width:640px;text-align:left;background:#ffffff;font-weight:300;color:#333333;font-family:Open Sans Light,Open Sans,Arial;mso-font-alt:Arial;font-size:16px;padding-left:65px;padding-right:65px;padding-bottom:0px;padding-top:0px;display: block;">\
                         ' . $r->content . '\
                         </span>\
                         </td>\
                         </tr>';
        $content_no_quotes = str_replace("'", "", $content_hd);
        $content           = "'" . $content_no_quotes . "'";

        Headers::create([
            'name'    => $name,
            'value'   => $name_simple,
            'content' => $content,
        ]);
        if (isset($image)) {
            $imageName  = 'header_' . $name_simple . $mime;
            $image_path = $path . $imageName;
            //$image_path = public_path("images/template/portefolio/{$imageName}"); //  make directory Newsllerter/images or header
            // Check if image already exists
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            if (File::exists($image_path)) {
                Session::flash('flash_error', "Imagem already exists!");
                return back()->withInput();
            } else {
                $image->move($path, $imageName);
            }
        }
        Session::flash('flash_success', "Header Successfully Created!");
        return redirect()->back();
    }

}
