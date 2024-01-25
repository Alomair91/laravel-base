<?php

namespace omairtech\laravel\base\dtos;

use Illuminate\Http\JsonResponse;

class Response implements \JsonSerializable
{
    /**
     * @var int $status
     */
    private $status = 200;

    /**
     * @var string $message
     */
    private mixed $message = "";

    /**
     * @var mixed $errors
     */
    private mixed $errors = null;

    /**
     * @var mixed $data
     */
    private mixed $data = null;

    /**
     * @var mixed $data
     */
    private mixed $meta = null;

    /**
     * @var array $headers
     */
    private $headers = [];

    public function __construct($status = 200, $data = null)
    {
        $this->status = $status;
        $this->data = $data ?? new \stdClass();
    }

    private function getResponse(): array
    {
        $data = [
            'status' => $this->getStatus() ?? (new \stdClass()),
            'message'     => $this->getMessage() ?? (new \stdClass()),
            'data'        => $this->getData() ?? (new \stdClass()),
        ];
        if($meta = $this->getMeta())
            $data["meta"] = $meta;
        if($errors = $this->getErrors())
            $data["errors"] = $errors;
        return $data;
    }

    /**
     * return the data that can be serialized as json
     */
    public function jsonSerialize()
    {
        return $this->getResponse();
    }

    /**
     * build and return the json response
     *
     * @return JsonResponse
     */
    public function json(): JsonResponse
    {
        return response()->json($this->getResponse(), $this->getStatus(), $this->getHeaders(),);
    }

    /**
     * @return int|mixed
     */
    public function getStatus(): mixed
    {
        return $this->status;
    }

    /**
     * @param int|mixed $status
     * @return Response
     */
    public function setStatus(mixed $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage(): mixed
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     * @return Response
     */
    public function setMessage(mixed $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrors(): mixed
    {
        return $this->errors;
    }

    /**
     * @param mixed $errors
     * @return Response
     */
    public function setErrors(mixed $errors): self
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     * @return Response
     */
    public function setData(mixed $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMeta(): mixed
    {
        return $this->meta;
    }

    /**
     * @param mixed $meta
     * @return Response
     */
    public function setMeta(mixed $meta): self
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return Response
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }
}
