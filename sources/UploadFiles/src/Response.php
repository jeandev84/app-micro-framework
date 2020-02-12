<?php
namespace Theory;


/**
 * Class Response
 * @package Theory
*/
class Response
{

    /** @var string  */
    private $httpProtocol = '1.1';

    /** @var int */
    private $status;

    /** @var string */
    private $content;

    /** @var array  */
    private $headers = [];

    /**
     * Response constructor.
     * @param string $content
     * @param int $status
     * @param array $headers
     */
    public function __construct(string $content = null, int $status, array $headers = [])
    {
        $this->content = $content;
        $this->status = $status;
        $this->headers = $headers;
    }

    /**
     * @param int $status
    */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }


    /**
     * @param int $status
     * @return $this
    */
    public function withStatus(int $status)
    {
        $this->setStatus($status);
        return $this;
    }


    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }


    /**
     * @param string $content
     * @return $this
    */
    public function withContent(string $content)
    {
        $this->setContent($content);
        return $this;
    }


    /**
     * @param string $header
     */
    public function setHeader(string $header)
    {
        $this->headers[] = $header;
    }

    /**
     * @param string $header
     * @return $this
    */
    public function withHeader(string $header)
    {
        $this->setHeader($header);
        return $this;
    }

    /**
     * @param string $to
     * @return Response
    */
    public function redirect(string $to = '/')
    {
        if(headers_sent()) { return $this; }
        header('Location: '. $to);
        exit;
    }


    /**
     * Send headers and content  to the server
    */
    public function send()
    {
        if(headers_sent())
        {
            return $this;
        }

        // add protocol http: HTTP 1.1 200 OK

        // send code status
        http_response_code($this->status);

        // send headers
        $this->sendHeaders();

        // send content
        $this->sendContent();
    }

    /**
     * Send content
    */
    public function sendContent()
    {
        echo $this->content;
    }


    /**
     * Send content
    */
    public function sendHeaders()
    {
        foreach ($this->headers as $header)
        {
            header($header);
        }
    }
}


/**
 * @return Response
*/
function response()
{
    return new Response();
}

