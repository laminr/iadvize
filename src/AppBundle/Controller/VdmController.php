<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Vdm;
use AppBundle\Form\VdmType;

/**
 * Vdm controller.
 *
 * @Route("/vdm")
 */
class VdmController extends Controller
{

    /**
     * Lists all Vdm entities.
     *
     * @Route("/", name="_vdm")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Vdm')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Vdm entity.
     *
     * @Route("/", name="vdm_create")
     * @Method("POST")
     * @Template("AppBundle:Vdm:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Vdm();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vdm_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Vdm entity.
     *
     * @param Vdm $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Vdm $entity)
    {
        $form = $this->createForm(new VdmType(), $entity, array(
            'action' => $this->generateUrl('vdm_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Vdm entity.
     *
     * @Route("/new", name="vdm_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Vdm();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Vdm entity.
     *
     * @Route("/{id}", name="vdm_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Vdm')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vdm entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Vdm entity.
     *
     * @Route("/{id}/edit", name="vdm_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Vdm')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vdm entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Vdm entity.
    *
    * @param Vdm $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Vdm $entity)
    {
        $form = $this->createForm(new VdmType(), $entity, array(
            'action' => $this->generateUrl('vdm_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Vdm entity.
     *
     * @Route("/{id}", name="vdm_update")
     * @Method("PUT")
     * @Template("AppBundle:Vdm:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Vdm')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vdm entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('vdm_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Vdm entity.
     *
     * @Route("/{id}", name="vdm_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Vdm')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vdm entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vdm'));
    }

    /**
     * Creates a form to delete a Vdm entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vdm_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
