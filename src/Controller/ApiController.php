<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\TwitterBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /**
     * Passes a request to the Twitter API while adding OAuth headers. This enables
     * you to expose the Twitter API on your own domain.
     *
     * @Route("{name}.{format}", requirements={"name"=".+", "format"="(json|xml)"})
     * @Template()
     */
    public function apiAction($name, $format, Request $request)
    {
        $method = $request->getMethod();

        $parameters = array();
        foreach ($request->query as $key => $value) {
            $parameters[$key] = $value;
        }
        foreach ($request->request as $key => $value) {
            $parameters[$key] = $value;
        }

        $twitter = $this->get('endroid.twitter');
        $response = $twitter->query($name, $method, $format, $parameters);

        return new Response(
            $response->getContent(),
            $response->getStatusCode(),
            array(
                'Content-Type' => $response->getHeader('Content-Type'),
            )
        );
    }
}
