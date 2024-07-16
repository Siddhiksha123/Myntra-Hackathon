<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>3D Model of a Girl</title>
    <style>
      body {
        margin: 0;
      }

 
    </style>
  </head>
  <body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>

    <script>
      // Scene setup
      const scene = new THREE.Scene();
      scene.background = null; // Make the background transparent

      const camera = new THREE.PerspectiveCamera(
        75,
        window.innerWidth / window.innerHeight,
        0.1,
        1000
      );
      const renderer = new THREE.WebGLRenderer({ alpha: true }); // Support transparency
      renderer.setSize(window.innerWidth, window.innerHeight);
      document.body.appendChild(renderer.domElement);

      // Light setup
      const light = new THREE.DirectionalLight(0xffffff, 1);
      light.position.set(5, 5, 5).normalize();
      scene.add(light);

      // Load the 3D model
      const loader = new THREE.GLTFLoader();
      let model;
      loader.load(
        "girl1.glb",
        function (gltf) {
          model = gltf.scene;
          scene.add(model);
         model.scale.set(2, 2, 2);   
          animate();
        },
        undefined,
        function (error) {
          console.error("An error occurred while loading the model:", error);
        }
      );

      // Camera position
      camera.position.z = 15;

      // Animation loop
      function animate() {
        requestAnimationFrame(animate);
        renderer.render(scene, camera);
      }

      // Handle window resize
      window.addEventListener("resize", () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
      });

      // Handle zoom
      window.addEventListener("wheel", (event) => {
        event.preventDefault();
        const zoomFactor = 0.7;
        if (event.deltaY < 0) {
          camera.position.z -= zoomFactor;
        } else {
          camera.position.z += zoomFactor;
        }
      });

      // Variables for rotation
      let isDragging = false;
      let previousMousePosition = { x: 0, y: 0 };

      // Handle mouse down event
      document.addEventListener("mousedown", (event) => {
        isDragging = true;
        previousMousePosition = { x: event.clientX, y: event.clientY };
      });

      // Handle mouse move event
      document.addEventListener("mousemove", (event) => {
        if (isDragging && model) {
          const deltaMove = {
            x: event.clientX - previousMousePosition.x,
            y: event.clientY - previousMousePosition.y,
          };

          const rotationSpeed = 0.002;
          model.rotation.y += deltaMove.x * rotationSpeed;
          model.rotation.x += deltaMove.y * rotationSpeed;

          previousMousePosition = {
            x: event.clientX,
            y: event.clientY,
          };
        }
      });

      // Handle mouse up event
      document.addEventListener("mouseup", () => {
        isDragging = false;
      });

      // Handle mouse leave event
      document.addEventListener("mouseleave", () => {
        isDragging = false;
      });
    </script>
  </body>
</html>
