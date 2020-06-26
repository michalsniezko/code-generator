<?php

namespace App\Controller;

use App\Form\GeneratorFormType;
use App\Service\CodeGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /** @var string */
    private const FILENAME = 'codes.txt';

    /** @var CodeGenerator */
    private $generator;

    /**
     * MainController constructor.
     * @param CodeGenerator $generator
     */
    public function __construct(CodeGenerator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @Route("/", name="main")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(GeneratorFormType::class);
        $form->handleRequest($request);
        $logicError = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            try {
                $file = $this->generator->getFileWithCodes($data['numberOfCodes'], $data['lengthOfCode']);
                $response = new BinaryFileResponse($file);
                $response->headers->set('Content-Type', 'text/plain');
                $response->setContentDisposition(
                    ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                    self::FILENAME
                );

                return $response;
            } catch (\LogicException $exception) {
                $logicError = $exception->getMessage();
            }
        }

        return $this->render('main.html.twig', [
            'form' => $form->createView(),
            'error' => $logicError,
        ]);
    }
}
