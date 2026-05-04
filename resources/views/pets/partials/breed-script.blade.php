<script>
    const dogBreeds = [
        'Affenpinscher','Afghan Hound','Airedale Terrier','Akita','Alaskan Malamute',
        'American Bulldog','American Eskimo Dog','American Foxhound','American Pit Bull Terrier',
        'American Staffordshire Terrier','Australian Cattle Dog','Australian Shepherd',
        'Australian Terrier','Basenji','Basset Hound','Beagle','Bearded Collie',
        'Belgian Malinois','Belgian Tervuren','Bernese Mountain Dog','Bichon Frise',
        'Bloodhound','Border Collie','Border Terrier','Borzoi','Boston Terrier',
        'Boxer','Boykin Spaniel','Brittany','Brussels Griffon','Bull Terrier',
        'Bulldog','Bullmastiff','Cairn Terrier','Cane Corso','Cavalier King Charles Spaniel',
        'Chesapeake Bay Retriever','Chihuahua','Chinese Crested','Chinese Shar-Pei',
        'Chow Chow','Cocker Spaniel','Collie','Dachshund','Dalmatian',
        'Doberman Pinscher','English Setter','English Springer Spaniel','Flat-Coated Retriever',
        'French Bulldog','German Shepherd','German Shorthaired Pointer','Giant Schnauzer',
        'Golden Retriever','Great Dane','Great Pyrenees','Greyhound','Havanese',
        'Irish Setter','Irish Wolfhound','Italian Greyhound','Jack Russell Terrier',
        'Labrador Retriever','Lhasa Apso','Maltese','Mastiff','Miniature Pinscher',
        'Miniature Schnauzer','Newfoundland','Norfolk Terrier','Norwegian Elkhound',
        'Old English Sheepdog','Papillon','Pekingese','Pembroke Welsh Corgi','Pointer',
        'Pomeranian','Poodle (Miniature)','Poodle (Standard)','Poodle (Toy)',
        'Portuguese Water Dog','Pug','Rhodesian Ridgeback','Rottweiler','Saint Bernard',
        'Samoyed','Scottish Terrier','Shetland Sheepdog','Shiba Inu','Shih Tzu',
        'Siberian Husky','Soft Coated Wheaten Terrier','Staffordshire Bull Terrier',
        'Standard Schnauzer','Vizsla','Weimaraner','West Highland White Terrier',
        'Whippet','Wire Fox Terrier','Xoloitzcuintli','Yorkshire Terrier',
        'Mixed Breed','Other (Custom)'
    ];

    const catBreeds = [
        'Abyssinian','American Bobtail','American Curl','American Shorthair','American Wirehair',
        'Balinese','Bengal','Birman','Bombay','British Longhair','British Shorthair',
        'Burmese','Burmilla','Chartreux','Chausie','Colorpoint Shorthair',
        'Cornish Rex','Devon Rex','Domestic Longhair','Domestic Shorthair',
        'Egyptian Mau','European Shorthair','Exotic Shorthair','Havana Brown',
        'Himalayan','Japanese Bobtail','Khao Manee','Korat','LaPerm',
        'Maine Coon','Manx','Munchkin','Nebelung','Norwegian Forest Cat',
        'Ocicat','Oriental Longhair','Oriental Shorthair','Persian',
        'Peterbald','Pixiebob','Ragamuffin','Ragdoll','Russian Blue',
        'Savannah','Scottish Fold','Selkirk Rex','Siamese','Siberian',
        'Singapura','Snowshoe','Somali','Sphynx','Thai','Tonkinese',
        'Toyger','Turkish Angora','Turkish Van','York Chocolate',
        'Mixed Breed','Other (Custom)'
    ];

    function populateBreeds(petType, breedSelect) {
        const current = breedSelect.value;
        breedSelect.innerHTML = '<option value="">Select Breed</option>';
        const breeds = petType === 'Dog' ? dogBreeds : petType === 'Cat' ? catBreeds : [];
        breeds.forEach(breed => {
            const option = document.createElement('option');
            option.value = breed;
            option.textContent = breed;
            if (breed === current) option.selected = true;
            breedSelect.appendChild(option);
        });
    }

    function initBreedDropdown(petTypeId, breedId, customContainerId, customInputId, currentBreed) {
        const petTypeSelect = document.getElementById(petTypeId);
        const breedSelect = document.getElementById(breedId);
        const customContainer = document.getElementById(customContainerId);
        const customInput = document.getElementById(customInputId);

        petTypeSelect.addEventListener('change', function () {
            populateBreeds(this.value, breedSelect);
            customContainer.classList.add('hidden');
            customInput.value = '';
            customInput.required = false;
        });

        breedSelect.addEventListener('change', function () {
            if (this.value === 'Other (Custom)') {
                customContainer.classList.remove('hidden');
                customInput.required = true;
            } else {
                customContainer.classList.add('hidden');
                customInput.required = false;
                customInput.value = '';
            }
        });

        document.querySelector('form').addEventListener('submit', function () {
            if (breedSelect.value === 'Other (Custom)' && customInput.value.trim()) {
                breedSelect.value = customInput.value.trim();
            }
        });

        // Initialize on load
        if (petTypeSelect.value) {
            populateBreeds(petTypeSelect.value, breedSelect);
            if (currentBreed) {
                const exists = Array.from(breedSelect.options).some(o => o.value === currentBreed);
                if (exists) {
                    breedSelect.value = currentBreed;
                } else {
                    breedSelect.value = 'Other (Custom)';
                    customContainer.classList.remove('hidden');
                    customInput.value = currentBreed;
                    customInput.required = true;
                }
            }
        }
    }
</script>
