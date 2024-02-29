package com.snazzy.crm.service;

import com.snazzy.crm.search.Search;
import com.snazzy.crm.search.SearchRepository;
import org.springframework.data.domain.Pageable;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class SearchService {
    public <T> List<T> search(Search search, SearchRepository repository) {
        return repository.search(search);
    }

    public <T> List<T> search(Search search, SearchRepository repository, Pageable pageable) {
        return repository.search(search, pageable);
    }
}
